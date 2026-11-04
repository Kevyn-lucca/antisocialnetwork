<?php

namespace App\Http\Controllers;

use App\Models\Antis;
use App\Services\GeminiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class AIController extends Controller
{
  public function __invoke(Request $request, GeminiService $geminiService): View
{
    $validated = $request->validate([
        'prompt' => 'nullable|string|max:2000',
    ]);

    $messages = Antis::query()
        ->where('user_id', $request->user()->getAuthIdentifier())
        ->latest()
        ->take(100)
        ->pluck('message')
        ->implode("\n- ");

    if ($messages === '') {
        return view('Resume', ['data' => 'Nenhuma mensagem para resumir.']);
    }

$prompt = <<<PROMPT
Você é um assistente que resume o que ocorreu nessa rede social a parti das mensagens abaixo, seja sarcastico e mal humorado.

Regras:
- Responda em português do Brasil.
- Gere apenas HTML válido, sem markdown e sem blocos de código (não use ```).
- Use somente estas tags: <h3>, <p>, <ul>, <li>, <strong>.
- Estrutura: um <p> com um resumo geral de até 3 frases, depois um <h3>Pontos principais</h3> seguido de uma <ul> com os pontos em <li>. Se houver prazos, tarefas ou decisões, destaque com <strong>.
- Não invente informações que não estejam nas mensagens.
- Não inclua <html>, <head>, <body>, <style>, <script> nem atributos de classe ou estilo.

Mensagens:
- {$messages}
PROMPT;


    if (! empty($validated['prompt'])) {
        $prompt .= "\n\nInstrução adicional: ".$validated['prompt'];
    }

    


$response = strip_tags($geminiService->generateText($prompt), '<h3><p><ul><li><strong>');

$response = preg_replace('/^```(?:html)?\s*|\s*```$/m', '', $response);

    return view('Resume', ['data' => $response]);
}
}
