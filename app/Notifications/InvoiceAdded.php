<?php

namespace App\Notifications;

use App\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvoiceAdded extends Notification
{
    use Queueable;

    private $invoice;

    /**
     * Create a new notification instance.
     *
     * @param Invoice $invoice
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     */
    public function via($notifiable)
    {
        // flashing notification data to session
        flashToSession($this->message());

    }

    private function message() {
        $type = ucfirst($this->invoice->type);

        return [
            'title' => "{$type} Added",
            'body' => "{$type}#{$this->invoice->id} has been added.",
            'type' => 'success' // success, error, info
        ];
    }
}
