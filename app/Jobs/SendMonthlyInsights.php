<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\MonthlyInsightsMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendMonthlyInsights implements ShouldQueue
{
    use Queueable;


    public function handle(): void
    {
        User::whereNotNull('insight_day')
            ->where('insight_day', now()->day)
            ->each(function (User $user) {
                Mail::to($user->email)->send(new MonthlyInsightsMail($user));
            });
    }
}
