<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Arena;
use Auth;

class ArenaController extends Controller
{
    public function __construct(Arena $arenas)
    {
        $this->arenas = $arenas;
    }

    public function index()
    {
        $arena = $this->arenas->with('participants')->whereStatus('open')->first();

        if (! $arena) {
            return view('arena.unavailable');
        }
        $isSubscribed = $arena->isSubscribed(Auth::user()->id);

        return view('arena.index', compact('arena', 'isSubscribed'));
    }

    public function signUp(Request $request)
    {
        $arena = $this->arenas->with('participants')->whereStatus('open')->first();
        $user = Auth::user();

        if (! $arena->isOpen()) {
            return redirect()->back()
                ->withError('Essa arena está fechada para inscrições');
        }

        if ($arena->isSubscribed($user->id)) {
            return redirect()->back()
                ->withError('Você já está inscrito para esta arena.');
        }

        if ($user->gold < $arena->getCost()) {
            return redirect()->back()
                ->withError('Você não tem ouro o suficiente.');
        }

        $user->gold -= $arena->getCost();
        $user->save();
        $arena->participants()->save($user);

        return redirect()->back();
    }
}
