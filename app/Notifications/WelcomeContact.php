<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Mail\WelcomeContactMail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeContact extends Notification implements ShouldQueue
{
    use Queueable;

    protected $username;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $username)
    {
        $this->username = $username;
    }

    /**
     * Determine if the notification should be sent.
     */
    public function shouldSend(object $notifiable, string $channel): bool
    {
        return !$notifiable->notificationHistory()->where('notification', self::class)->exists();
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
    public function toMail(object $notifiable): Mailable
    {
        $mailable = (new WelcomeContactMail($this->username))
            ->to($notifiable->email);
        $notifiable->notificationHistory()->create([
            'id' => (string) Str::orderedUuid(),
            'contact_id' => $notifiable->id,
            'notification' => self::class,
            'channel' => 'mail',
        ]);
        return $mailable;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
