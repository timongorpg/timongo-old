<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\UserRegistered as UserRegisteredMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class UserRegisteredListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param UserRegistered $event
     *
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $user = $event->getUser();

        Mail::to($user->email)->send(new UserRegisteredMail($user));
    }
}
