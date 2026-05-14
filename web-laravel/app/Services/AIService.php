<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.groq.com/openai/v1/chat/completions';
    protected $model = 'llama-3.3-70b-versatile';

    public function __construct()
    {
        $this->apiKey = config('services.groq.key');
    }

    public function analyzeIncident(string $description)
    {
        if (!$this->apiKey) {
            Log::warning('Groq API Key missing in configuration.');
            return $this->getMockAnalysis($description);
        }

        try {
            $prompt = "### ROLE
            You are a DHL Intelligence System. Classify incoming reports with 100% accuracy.

            ### TASK
            Analyze this message: \"{$description}\"

            ### KEYWORD DICTIONARY
            1. Damaged Parcel: crushed, wet, soaked, leaking, shattered, ruined, spoiled, bent, tampered, smashed, dented, box torn, opened.
            2. Late Delivery: overdue, behind schedule, slow, held up, stuck in transit, sorting center, past due, days late, still waiting.
            3. Missing Parcel: lost, vanished, stolen, empty box, empty envelope, theft, package gone, not received, where is it.
            4. Address Issue: wrong house, incorrect street, zip code error, returned to sender, undeliverable, misrouted.
            5. System Error: website down, portal error, app crash, technical glitch, tracking not updating, login issue.
            6. Customer Complaint: rude courier, unprofessional, bad service, courier behavior, feedback, staff attitude.

            ### EMOTION & PRIORITY RULES
            - CRITICAL: Very angry (Caps/Aggressive), high-value items (Laptop, Phone, Jewellery), total loss, or safety issues.
            - HIGH: Frustrated, mentions long delays (5+ days), or business-impact.
            - MEDIUM: Standard issue report, neutral tone.
            - LOW: Polite inquiry, general feedback.

            ### OUTPUT
            Return ONLY a JSON object:
            {
              \"summary\": \"Concise 1-sentence summary.\",
              \"category\": \"[Choose best match from Dictionary]\",
              \"priority\": \"[Choose best match from Rules]\",
              \"insights\": \"Explain emotion + keywords detected.\"
            }";

            $response = Http::withoutVerifying()
                ->withToken($this->apiKey)
                ->post($this->baseUrl, [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'response_format' => ['type' => 'json_object'],
                    'temperature' => 0.1
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $content = $data['choices'][0]['message']['content'] ?? null;
                
                if ($content) {
                    $result = json_decode($content, true);
                    Log::info('Groq AI Success:', $result);
                    return $result;
                }
            }

            Log::error('Groq API Fail: ' . $response->status() . ' - ' . $response->body());
            return $this->getMockAnalysis($description);

        } catch (\Exception $e) {
            Log::error('Groq AI Analysis Error: ' . $e->getMessage());
            return $this->getMockAnalysis($description);
        }
    }

    protected function getMockAnalysis(string $description)
    {
        return [
            'summary' => 'Incident reported regarding: ' . substr($description, 0, 50) . '...',
            'category' => 'Customer Complaint',
            'priority' => 'Medium',
            'insights' => 'Manual review required (AI Switch Active).'
        ];
    }
}
