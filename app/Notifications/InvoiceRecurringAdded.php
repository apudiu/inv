<?php

namespace App\Notifications;

use App\InvoiceRecur;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvoiceRecurringAdded extends Notification
{
    use Queueable;

    private $invoiceRecur;

    /**
     * Create a new notification instance.
     *
     * @param Invoice $invoice
     */
    public function __construct(InvoiceRecur $invoiceRecur)
    {
        $this->invoiceRecur = $invoiceRecur;
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
        return [
            'title' => "Invoice Recurring Added",
            'body' => "Invoice #{$this->invoiceRecur->invoice_id} has been added to recurring list.",
            'type' => 'success' // success, error, info
        ];
    }
}
