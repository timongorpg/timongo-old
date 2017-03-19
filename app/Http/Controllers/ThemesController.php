<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ThemesController extends Controller
{
    public function changeTheme(Request $request)
    {
        $this->validate($request, [
            'theme' => 'required|numeric'
        ]);

        $user = Auth::user();
        $user->theme = $request->theme;

        $user->save();

        return redirect()->back();
    }
}
