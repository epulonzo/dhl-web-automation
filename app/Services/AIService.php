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
            return $this->getMockAnalysis($description);
        }

        try {
            $prompt = "Analyze the following logistics incident description and provide a professional assessment. 
            Description: \"{$description}\"
            
            Return the result ONLY as a JSON object with these exact keys:
            - summary: A concise 1-sentence professional summary.
            - category: Must be one of [Late Delivery, Damaged Parcel, Missing Parcel, Address Issue, System Error, Customer Complaint].
            - priority: Must be one of [Low, Medium, High, Critical].
            - insights: A brief explanation of why this category/priority was chosen.";

            $response = Http::post("{$this->baseUrl}?key={$this->apiKey}", [
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
                    return json_decode($textResponse, true);
                }
            }

            Log::error('Gemini API Error: ' . $response->body());
            return $this->getMockAnalysis($description);

        } catch (\Exception $e) {
            Log::error('AI Analysis Exception: ' . $e->getMessage());
            return $this->getMockAnalysis($description);
        }
    }

    protected function getMockAnalysis(string $description)
    {
        // Fallback logic if API key is missing or fails
        return [
            'summary' => 'Incident reported regarding: ' . substr($description, 0, 50) . '...',
            'category' => 'System Error',
            'priority' => 'Medium',
            'insights' => 'AI Analysis skipped (Check API Configuration).'
        ];
    }
}
