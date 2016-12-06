<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        return view('welcome', [
            'elite' => $this->users->orderBy('level', 'DESC')->take(3)->get()
        ]);
    }

    public function privacy()
    {
        return view('privacy');
    }
}
