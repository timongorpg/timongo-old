<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use App\User;

class UsersController extends Controller
{
    protected $guard;

    protected $users;

    public function __construct(Guard $guard, User $users)
    {
        $this->guard = $guard;
        $this->users = $users;
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

    public function profile($slug)
    {
        $profile = $this->users->with('guild')->where('nickname', $slug)->first();

        return $profile ? view('users.profile', compact('profile')) : view('users.not-found');
    }
}
