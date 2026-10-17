<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Services\AI\FinancialAnalysisService;


class MonthlyInsightsMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $insights;

    public function __construct( public User $user)
    {
        $this->insights = app(FinancialAnalysisService::class)->analyse($user);
        
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Seus gastos do mês -' . now()->subMonth()->format('m/Y'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.monthly-insights',
        );
    }

}
