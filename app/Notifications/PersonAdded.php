<?php

namespace App\Notifications;

use App\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PersonAdded extends Notification
{
    use Queueable;

    private $person;


    /**
     * Create a new notification instance.
     *
     * @param Person $person
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
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
            'title' => "Contact Person Added",
            'body' => "{$this->person->name} has been added.",
            'type' => 'success' // success, error, info
        ];
    }
}
