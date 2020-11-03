<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TestNotification extends Notification
{
    use Queueable;

    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Message From BroadCasting')
            ->line('Hello from broadcasting its amazing to broadcast realtime notification');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            $this->message,
        ];
    }

    public function toBroadcast($notifiable)
    {
        $timestamp = Carbon::now()->addSecond()->toDateString();
        return new BroadcastMessage([
            'notifiable_id'   => $notifiable->id,
            'notifiable_type' => get_class($notifiable),
            'data'            => $this->message,
            'read_at'         => null,
            'created_at'      => $timestamp,
            'updated_at'      => $timestamp,
        ]);
    }
}
