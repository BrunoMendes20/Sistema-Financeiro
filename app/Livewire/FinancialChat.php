<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\AI\FinancialAnalysisService;
use Illuminate\View\View;
class FinancialChat extends Component
{
   public string $message = '';
   public array $history = [];

   public function mount(): void
    {
        $this->history = Auth::user()
            ->chatMessages()
            ->orderBy('created_at')
            ->get()
            ->map(fn($msg) =>[
                'role' => $msg->role,
                'content' => $msg->content

            ])
            ->toArray();             
    }

    public function sendMessage(): void
    {
        $this->validate([
            'message' => ['required', 'string', 'min:3',' max:1000'],
        ]);

        $user = Auth::user();

        // Save user message to the database
        $user->chatMessages()->create([
            'role' => 'user', 
            'content' => $this->message,
        ]);

        $this->history[] = [
            'role' => 'user',
            'content' => $this->message,
        ];

        // Send to AI service for analysis and get the response
        $response = app(FinancialAnalysisService::class)
            ->chat($user, $this->message, $this->history);

        // Save AI response to the database
        $user->chatMessages()->create([
            'role' => 'assistant',
            'content' => $response,
        ]);

        $this->dispatch('scroll-to-bottom');

        $this->history[] = [
            'role' => 'assistant',
            'content' => $response,
        ];

        $this->message = ''; 
    }

    public function clearHistory(): void
    {
        Auth::user()->chatMessages()->delete();
        $this->history = [];
    }

    public function render(): View
    {
        return view('components.financial-chat');
    }
}
