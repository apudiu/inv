<?php

namespace App\Notifications;

use App\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectAdded extends Notification
{
    use Queueable;

    private $project;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return void
     */
    public function via($notifiable)
    {
        // flashing notification data to session
        flashToSession($this->message());
    }

    private function message() {
        return [
            'title' => "Project Added",
            'body' => "{$this->project->name} - has been added.",
            'type' => 'success' // success, error, info
        ];
    }
}
