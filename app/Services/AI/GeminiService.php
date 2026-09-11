<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;
use Exception;

class GeminiService
{
    protected  string $apiKey;
    protected  string $baseUrl;
    protected  string $model;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');

        $this->model = 'gemini-3.6-flash';

        $this->baseUrl = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent";
    }

    public function sendPrompt(string $prompt, bool $jsonMode = false): string|array
    {
        $payload = [
            'contents' => [
                'parts' => [
                    ['text' => $prompt]
                ]
            ]
        ];

        if ($jsonMode)
        {
            $payload['generationConfig'] = [
                'responseMimeType' => 'application/json',
            ];
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->timeout(60)
        ->retry(3, 1000) // Retry 3 times with 1 second delay
        ->post("{$this->baseUrl}?key={$this->apiKey}", $payload);

        if ($response->failed())
        {
            throw new Exception("Falha ao comunicar com a API do Gemini: " . $response->body());
        }

        $textResponse = $response->json('candidates.0.content.parts.0.text');

        if ($jsonMode)
        {
            return json_decode($textResponse, true);
        }

        return $textResponse;

    }


}
