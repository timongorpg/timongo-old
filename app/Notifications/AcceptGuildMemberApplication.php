<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class AcceptGuildMemberApplication extends Notification implements ShouldQueue
{
    use Queueable;

    protected $guild;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($guild)
    {
        $this->guild = $guild;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "Você foi aceito como membro da guilda {$this->guild}.",
            'alert'   => 'success',
        ];
    }
}
