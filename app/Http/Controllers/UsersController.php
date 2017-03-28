<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;

class UsersController extends Controller
{
    protected $guard;

    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    public function notifications()
    {
        $notifications = $this->guard->user()->notifications;

        $notifications->each->markAsRead();

        return view('users.notifications', compact('notifications'));
    }

    public function settings()
    {
        return view('users.settings');
    }
}
