<?php

namespace App\Http\Controllers;

use App\Arena;
use App\Timongo\Battle\PvP;
use Auth;
use Illuminate\Http\Request;

class ArenaController extends Controller
{
    protected $arenas;

    protected $pvp;

    public function __construct(Arena $arenas, PvP $pvp)
    {
        $this->arenas = $arenas;
        $this->pvp = $pvp;
    }

    public function index()
    {
        $arena = $this->arenas->with('participants')->whereStatus('open')->first();
        $loggedUser = Auth::user();

        if (!$arena) {
            return view('arena.unavailable');
        }

        //Remove logged in user
        $arena->participants = $arena->participants->filter(function ($user) use ($loggedUser) {
            return $loggedUser->id != $user->id && $loggedUser->isWorthyOpponent($user);
        });

        if ($arena->isSubscribed($loggedUser->id)) {
            return view('arena.simple', compact('arena'));
        }

        return  view('arena.subscribe', compact('arena'));
    }

    public function signUp(Request $request)
    {
        $arena = $this->arenas->with('participants')->whereStatus('open')->first();
        $user = Auth::user();

        // if (! $arena->isOpen()) {
        //     return redirect()->back()
        //         ->withError('Essa arena está fechada para inscrições');
        // }

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

    public function battle(Request $request, $userId)
    {
        $user = Auth::user();

        if ($user->current_stamina < 10) {
            return redirect('/arena')
                ->with('error', 'Você não tem energia o suficiente. A energia recupera com o tempo.');
        }

        $arena = $this->arenas->with('participants')->whereStatus('open')->first();

        if (!$hero = $arena->participants->find($user->id)) {
            return redirect('/arena')
                ->withError('Você só pode enfrentar alguém que está na arena.');
        }

        if (!$opponent = $arena->participants->find($userId)) {
            return redirect('/arena')
                ->withError('Você só pode enfrentar alguém que está na arena.');
        }

        $log = $this->pvp->battle($hero, $opponent);

        return view('battle-pvp-results', [
            'log'      => $log,
            'opponent' => $opponent,
        ]);
    }
}
