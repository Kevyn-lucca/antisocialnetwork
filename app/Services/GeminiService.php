<?php

namespace App\Services;

use Gemini\Laravel\Facades\Gemini;

class GeminiService
{
public function generateText(string $prompt): string
{
    try {
        return Gemini::generativeModel(config('gemini.model'))
            ->generateContent($prompt)
            ->text();
    } catch (\Throwable $e) {
        return 'Erro ao chamar o Gemini: '.$e->getMessage();
    }
}
}
