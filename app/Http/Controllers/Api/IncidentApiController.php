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
        // Simple Token Check for Bot Security
        $botToken = $request->header('X-Bot-Token');
        if ($botToken !== config('services.bot.token', 'dhl_uipath_secret_2026')) {
            return response()->json(['error' => 'Unauthorized Bot Access'], 401);
        }

        $validated = $request->validate([
            'message' => 'required|string',
            'sender' => 'nullable|string',
            'tracking_number' => 'nullable|string',
        ]);

        try {
            // Trigger Gemini AI Analysis
            $aiResult = $this->aiService->analyzeIncident($validated['message']);

            // Normalize AI response casing for database consistency
            $category = ucwords(strtolower($aiResult['category'] ?? 'Customer Complaint'));
            $priority = ucwords(strtolower($aiResult['priority'] ?? 'Medium'));

            $incident = Incident::create([
                'title' => 'Bot Reported: ' . ($validated['tracking_number'] ?? 'New Complaint'),
                'description' => $validated['message'],
                'category' => $category,
                'priority' => $priority,
                'status' => 'New',
                'tracking_number' => $validated['tracking_number'] ?? null,
                'ai_summary' => $aiResult['summary'] ?? null,
                'ai_suggested_category' => $category,
                'ai_suggested_priority' => $priority,
                'ai_raw_response' => $aiResult,
            ]);

            return response()->json([
                'success' => true,
                'incident_id' => $incident->id,
                'ai_analysis' => $aiResult
            ], 201);

        } catch (\Exception $e) {
            Log::error('API Incident Store Failure: ' . $e->getMessage());
            return response()->json(['error' => 'Server Error'], 500);
        }
    }
}
