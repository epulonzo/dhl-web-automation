<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    protected $apiKey;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    public function analyzeIncident(string $description)
    {
        if (!$this->apiKey) {
            Log::warning('Gemini API Key missing in configuration.');
            return $this->getMockAnalysis($description);
        }

        try {
            $prompt = "You are a DHL Logistics AI Assistant. Analyze the following incident report:
            \"{$description}\"
            
            Return the result ONLY as a JSON object with these exact keys:
            - summary: A professional 1-sentence summary starting with 'Incident involves...'.
            - category: Pick the best match from [Late Delivery, Damaged Parcel, Missing Parcel, Address Issue, System Error, Customer Complaint].
            - priority: Pick the best match from [Low, Medium, High, Critical].
            - insights: A brief explanation of the keywords that triggered this classification.";

            // Added 'withoutVerifying()' for local XAMPP/Windows compatibility
            $response = Http::withoutVerifying()->post("{$this->baseUrl}?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'response_mime_type' => 'application/json',
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $textResponse = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                
                if ($textResponse) {
                    $result = json_decode($textResponse, true);
                    Log::info('Gemini AI Success:', $result);
                    return $result;
                }
            }

            Log::error('Gemini API Response Error: ' . $response->status() . ' - ' . $response->body());
            return $this->getMockAnalysis($description);

        } catch (\Exception $e) {
            Log::error('AI Analysis Exception: ' . $e->getMessage());
            return $this->getMockAnalysis($description);
        }
    }

    protected function getMockAnalysis(string $description)
    {
        return [
            'summary' => 'Incident reported regarding: ' . substr($description, 0, 50) . '...',
            'category' => 'Customer Complaint',
            'priority' => 'Medium',
            'insights' => 'AI analysis unavailable. Manual review required.'
        ];
    }
}
