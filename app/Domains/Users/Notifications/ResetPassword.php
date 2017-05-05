<?php

namespace Lpf\Domains\Users\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Lpf\Domains\Users\User;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    protected $user;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token, User $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $name = $this->user->name;

        return (new MailMessage)
            ->view('emails.password')
            ->subject('Resetar senha')
            ->greeting('Olá ' . $name . '!')
            ->line('Clique no link para resetar sua senha:')
            ->action('Resetar sua senha', route('admin.auth.getResetPassword', $this->token));
    }
}
