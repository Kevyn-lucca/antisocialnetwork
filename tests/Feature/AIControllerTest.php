<?php

use App\Models\Antis;
use App\Models\User;
use App\Services\GeminiService;
use Mockery\MockInterface;

test('requires authentication', function () {
    $this->get('/ai/resume')
        ->assertRedirect('/login');
});

test('summarizes only the authenticated users messages', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    Antis::create([
        'user_id' => $user->id,
        'message' => 'Mensagem privada do usuário autenticado',
    ]);

    Antis::create([
        'user_id' => $otherUser->id,
        'message' => 'Mensagem privada de outra pessoa',
    ]);

    $this->mock(GeminiService::class, function (MockInterface $mock): void {
        $mock->shouldReceive('generateText')
            ->once()
            ->withArgs(function (string $prompt): bool {
                return str_contains($prompt, 'Mensagem privada do usuário autenticado')
                    && ! str_contains($prompt, 'Mensagem privada de outra pessoa')
                    && str_contains($prompt, 'Instrução adicional: Resuma em uma frase');
            })
            ->andReturn('Resumo gerado');
    });

    $this->actingAs($user)
        ->getJson('/ai/resume?prompt='.urlencode('Resuma em uma frase'))
        ->assertOk()
        ->assertExactJson(['data' => 'Resumo gerado']);
});

test('returns not found when the authenticated user has no messages', function () {
    $user = User::factory()->create();

    $this->mock(GeminiService::class, function (MockInterface $mock): void {
        $mock->shouldNotReceive('generateText');
    });

    $this->actingAs($user)
        ->getJson('/ai/resume')
        ->assertNotFound()
        ->assertExactJson(['data' => 'Nenhuma mensagem para resumir.']);
});

test('rejects an additional prompt longer than 2000 characters', function () {
    $user = User::factory()->create();

    $this->mock(GeminiService::class, function (MockInterface $mock): void {
        $mock->shouldNotReceive('generateText');
    });

    $this->actingAs($user)
        ->getJson('/ai/resume?prompt='.str_repeat('a', 2001))
        ->assertUnprocessable()
        ->assertJsonValidationErrors('prompt');
});
