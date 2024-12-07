<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    protected $token;
    protected $email;

    /**
     * Create a new notification instance.
     *
     * @param  string  $token
     * @param  string  $email
     * @return void
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        // Generate the reset URL manually
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $this->email
        ], false));

        return (new MailMessage)
            ->subject('Reset Your Password')  // Set a custom subject
            ->view('user.forgot-password.forgot-password-email', [
                'actionUrl' => $resetUrl  // Pass the reset URL to the view
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            // Define any additional data you want to include in the notification
        ];
    }
}
