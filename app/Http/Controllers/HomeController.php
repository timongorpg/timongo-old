<?php

namespace App\Http\Controllers;

use App\User;
use Auth;

class HomeController extends Controller
{
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            return redirect('/me');
        }

        $welcomeView = config('app.locale') == 'pt-br' ? 'welcome' : 'welcome-en';

        return view($welcomeView, [
            'elite' => $this->users->orderBy('level', 'DESC')->take(3)->get(),
        ]);
    }

    public function privacy()
    {
        return view('privacy');
    }
}
