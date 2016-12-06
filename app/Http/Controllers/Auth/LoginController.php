<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\User;

class LoginController extends Controller
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {
        if ($request->error) {
            return redirect('/');
        }

        $socialite = Socialite::driver('facebook')->user();

        $user = $this->users->whereEmail($socialite->getEmail())->first() ?:
            $this->users->newInstance($socialite->getRaw());

        $user->picture = $user->picture ?: asset('/img/no-pic-character.png');

        $user->save();

        Auth::loginUsingId($user->id);

        return redirect('/me');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
