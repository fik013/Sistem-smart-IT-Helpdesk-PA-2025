<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketStatusUpdatedNotification extends Notification
{
    use Queueable;

    public $ticket;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'ticket_status_updated',
            'title' => 'Status Tiket Diperbarui',
            'message' => 'Status tiket #' . $this->ticket->id . ' telah diperbarui menjadi ' . ucfirst($this->ticket->status) . '.',
            'url' => route('tickets.index'), // Or show ticket detail if available
            'ticket_id' => $this->ticket->id,
        ];
    }
}
