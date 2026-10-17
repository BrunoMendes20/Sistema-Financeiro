<?php

namespace App\Services\AI;

use App\Models\User;

use App\Services\AI\Prompts\CategoryPrompt;
use App\Services\AI\Prompts\ExpensePrompt;

class FinancialAnalysisService
{
    // Implementation for financial analysis using Gemini API

    public function __construct(
        protected GeminiService $gemini,
    ){}

    public function categorize(string $description): ?int
    {
        $prompt = (new CategoryPrompt)->build($description);

        $result = $this->gemini->sendPrompt($prompt,jsonMode: true);

        return isset($result['category_id']) ? (int) $result['category_id'] : null;

    }

    public function analyse(User $user): string
    {
        $lastMonth = now()->subMonth();

        $transactions = $user->transactions()
            ->with('category')
            ->whereMonth('date', $lastMonth->month)
            ->whereYear('date', $lastMonth->year)
            ->get()
            ->map(fn($t) => [
                'description' => $t->description,
                'amount' => $t->amount,
                'type' => $t->type,
                'category' => $t->category?->name ?? 'Sem categoria',
                'date' => $t->date->format('Y-m-d'),

            ]);
           
            $prompt = (new ExpensePrompt)->build($transactions->toArray());
          
            return $this->gemini->sendPrompt($prompt);
    }

    public function chat(User $user, string $message, array $history = []): string
    {
        $transactions = $user->transactions()
            ->with('category')
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->get()
            ->map(fn($t) => [
                'description' => $t->description,
                'amount' => $t->amount,
                'type' => $t->type,
                'category' => $t->category?->name ?? 'Sem categoria',
                'date' => $t->date->format('Y-m-d'),
            ]);

        $historyText = collect($history)->map(fn($msg) => 
            $msg['role'] === 'user'
                ? "Usuário: {$msg['content']}"
                : "Assistente: {$msg['content']}"
        )->join("\n");

         $prompt = <<<PROMPT
            Você é um assistente financeiro pessoal. Responda em português de forma clara e objetiva.

            Dados financeiros do usuário este mês:
            {$transactions->toJson()}

            Histórico da conversa:
            {$historyText}

            Usuário: {$message}
            Assistente:
            PROMPT;

        return $this->gemini->sendPrompt($prompt);
    }
}