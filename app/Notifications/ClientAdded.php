<?php

namespace App\Notifications;

use App\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ClientAdded extends Notification
{
    use Queueable;

    private $client;


    /**
     * Create a new notification instance.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     */
    public function via($notifiable)
    {
        // flashing notificatin data to session
        flashToSession($this->message());

    }

    private function message() {
        return [
            'title' => "Client Added",
            'body' => "{$this->client->name} has been added.",
        ];
    }
}
