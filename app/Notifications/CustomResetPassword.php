<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification
{
    public function __construct( public string $token)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }


    public function toMail(object $notifiable): MailMessage
    {
        $resetLink = route('password.reset', ['token' => $this->token, 'email' => $notifiable->email]);
        return (new MailMessage)
            ->subject('Recuperação de Senha')
            ->view('mail.notification-password', ['user' => $notifiable, 'resetLink' => $resetLink]);
    }

   
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
