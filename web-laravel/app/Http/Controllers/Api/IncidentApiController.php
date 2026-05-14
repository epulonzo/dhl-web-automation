<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Services\AIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IncidentApiController extends Controller
{
    protected $aiService;

    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Store a new incident from external source (UiPath Bot)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message'         => 'required|string',
            'sender'          => 'nullable|string',
            'tracking_number' => 'nullable|string',
        ]);

        try {
            // Use mock analysis to avoid long AI call timeouts from UiPath
            $category = 'Customer Complaint';
            $priority  = 'Medium';
            $summary   = 'Bot reported: ' . substr($validated['message'], 0, 80);

            // Try Groq AI but with a short timeout so server never hangs
            try {
                $aiResult = $this->aiService->analyzeIncident($validated['message']);
                $category = ucwords(strtolower($aiResult['category'] ?? $category));
                $priority  = ucwords(strtolower($aiResult['priority']  ?? $priority));
                $summary   = $aiResult['summary'] ?? $summary;
            } catch (\Exception $e) {
                Log::warning('AI skipped for bot request: ' . $e->getMessage());
            }

            $incident = Incident::create([
                'title'                  => 'Bot Reported: ' . ($validated['tracking_number'] ?? 'New Complaint'),
                'description'            => $validated['message'],
                'category'               => $category,
                'priority'               => $priority,
                'status'                 => 'New',
                'tracking_number'        => $validated['tracking_number'] ?? null,
                'ai_summary'             => $summary,
                'ai_suggested_category'  => $category,
                'ai_suggested_priority'  => $priority,
                'ai_raw_response'        => null,
            ]);

            return response()->json([
                'success'     => true,
                'incident_id' => $incident->id,
                'message'     => 'Incident created successfully',
            ], 201);

        } catch (\Exception $e) {
            Log::error('API Incident Store Failure: ' . $e->getMessage());
            return response()->json(['error' => 'Server Error: ' . $e->getMessage()], 500);
        }
    }
}
