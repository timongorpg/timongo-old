<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        return view('me', compact('user'));
    }
}
