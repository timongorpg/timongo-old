<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Creature;
use App\Mastery;
use App\Timongo\Battle\PvE;
use Auth;

class GameController extends Controller
{
    protected $creatures;

    protected $masteries;

    protected $pve;

    public function __construct(Creature $creatures, Mastery $masteries, PvE $pve)
    {
        $this->creatures = $creatures;
        $this->masteries = $masteries;
        $this->pve = $pve;
    }

    public function profile()
    {
        return view('me', [
            'masteries' => $this->masteries->orderBy('name')->get()
        ]);
    }

    public function adventures()
    {
        return view('adventures', [
            'creatures' => Auth::user()->getOpponents(),
            'adventureTip' => $this->getAdventureTip()
        ]);
    }

    public function inventory()
    {
        return view('inventory');
    }

    public function arena()
    {
        return view('arena');
    }

    public function battle(Request $request)
    {
        $this->validate($request, [
            'creature_id' => 'required'
        ]);

        $log = $this->pve->battle($request->creature_id);

        return view('battle-results', [
            'log' => $log,
            'creature_id' => $request->creature_id
        ]);
    }

    public function levelUp()
    {
        $user = Auth::user();

        if (! $user->hasEnoughExperience()) {
            return redirect('/me');
        }

        $user->levelUp()
            ->save();

        return redirect('/me')
            ->with([
                'levelUp' => true
            ]);
    }

    public function profession(Request $request)
    {
        $this->validate($request, [
            'profession_id' => 'required|in:2,3,4'
        ]);

        $user = Auth::user();

        if ($user->profession_id != 1) {
            return redirect('/me');
        }

        $user->profession_id = $request->profession_id;

        $user->save();

        return redirect('/me')->with([
            'newClass' => true
        ]);
    }

    public function mastery(Request $request)
    {
        $this->validate($request, [
            'mastery_id' => 'required|integer'
        ]);

        $user = Auth::user();

        if ($user->mastery_points == 0 || $user->isTraining()) {
            return redirect('/me');
        }

        $user->mastery_points -= 1;

        $user->startTraining($request->mastery_id)
            ->save();

        return redirect('/me');
    }

    public function train()
    {
        $user = Auth::user();

        if (! $user->trainFinished()) {
            return redirect('/me');
        }

        $user->finishTrain()
            ->save();

        return redirect('/me');
    }

    private function getAdventureTip()
    {
        $level = Auth::user()->level;

        if ($level <= 2) {
            return 'Creatures are filtered by hero\'s current level. We don\'t want you messing up with <strong>dragons</strong> too soon.';
        }

        if ($level <= 5) {
            return 'Weak creatures will stop showing as you get stronger.';
        }

        return 'You are such a good hunter. Do not forget to make some friends.';
    }
}
