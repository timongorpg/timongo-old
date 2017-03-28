<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class ArenaBattleDefeat extends Notification implements ShouldQueue
{
    use Queueable;

    protected $who;

    protected $when;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($who, $when)
    {
        $this->who = $who;
        $this->when = $when;
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
     * Get the broadcastable representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => "{$this->who} te derrotou na arena.",
        ]);
    }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'message' => "{$this->who} te derrotou na arena.",
            'when'    => $this->when,
            'alert'   => 'danger',
        ]);
    }
}
