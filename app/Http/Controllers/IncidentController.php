<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Services\AIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller
{
    protected $aiService;

    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function index(Request $request)
    {
        $query = Incident::with('assignedStaff');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('tracking_number', 'like', '%' . $request->search . '%');
        }

        $incidents = $query->latest()->paginate(10);

        return view('incidents.index', compact('incidents'));
    }

    public function create()
    {
        return view('incidents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'priority' => 'required|string',
            'tracking_number' => 'nullable|string|max:50',
            'attachment' => 'nullable|file|max:10240',
        ]);

        $incident = new Incident();
        $incident->fill($request->except('attachment'));
        $incident->status = 'New';

        // Trigger AI Analysis for Phase 2
        $aiResult = $this->aiService->analyzeIncident($request->description);
        if ($aiResult) {
            $incident->ai_summary = $aiResult['summary'] ?? null;
            $incident->ai_suggested_category = $aiResult['category'] ?? null;
            $incident->ai_suggested_priority = $aiResult['priority'] ?? null;
            $incident->ai_raw_response = $aiResult;
        }

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('attachments', $filename, 'public');
            $incident->attachment = $path;
        }

        $incident->save();

        return redirect()->route('incidents.show', $incident)->with('success', 'Incident reported. AI analysis complete.');
    }

    public function show(Incident $incident)
    {
        $incident->load('assignedStaff');
        return view('incidents.show', compact('incident'));
    }

    public function edit(Incident $incident)
    {
        return view('incidents.edit', compact('incident'));
    }

    public function update(Request $request, Incident $incident)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'priority' => 'required|string',
            'status' => 'required|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $incident->update($validated);

        return redirect()->route('incidents.show', $incident)->with('success', 'Incident updated successfully.');
    }

    public function destroy(Incident $incident)
    {
        $incident->delete();
        return redirect()->route('incidents.index')->with('success', 'Incident deleted.');
    }
}
