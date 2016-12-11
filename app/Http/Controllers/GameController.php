<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Creature;
use App\Mastery;
use App\Potion;
use App\Timongo\Battle\PvE;
use Auth;

class GameController extends Controller
{
    protected $creatures;

    protected $masteries;

    protected $potions;

    protected $pve;

    public function __construct(Creature $creatures, Mastery $masteries, Potion $potions, PvE $pve)
    {
        $this->creatures = $creatures;
        $this->masteries = $masteries;
        $this->potions = $potions;
        $this->pve = $pve;
    }

    public function profile()
    {
        return view('me', [
            'masteries' => $this->masteries->orderBy('name')->get(),
            'masteryTip' => $this->getMasteryTip()
        ]);
    }

    public function adventures()
    {
        return view('adventures', [
            'creatures' => Auth::user()->getOpponents(),
            'adventureTip' => $this->getAdventureTip()
        ]);
    }

    public function treasures()
    {
        return view('treasures', [
            'potions' => $this->potions->orderBy('name')->get()
        ]);
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

        if (Auth::user()->current_stamina < 6) {
            return redirect('/adventures')
                ->with('error', '<strong>Você não tem energia o suficiente</strong>. Compre uma poção na loja.');
        }

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

    public function potion(Request $request)
    {
        $this->validate($request, [
            'potion_id' => 'required',
            'amount' => 'required'
        ]);

        Auth::user()->buyPotion($request->potion_id, $request->amount)
            ->save();

        return redirect()->back();
    }

    public function usePotion(Request $request)
    {
        $this->validate($request, [
            'potion_id' => 'required'
        ]);

        Auth::user()->usePotion($request->potion_id)
            ->save();

        return redirect('/adventures');
    }

    public function pickNickname(Request $request)
    {
        $this->validate($request, [
            'nickname' => 'required|min:3|unique:users|max:16|alpha'
        ]);

        $user = Auth::user();

        $user->nickname = $request->nickname;

        $user->save();

        return redirect('/me');
    }

    public function donations()
    {
        return view('pages.donations');
    }

    private function getAdventureTip()
    {
        $level = Auth::user()->level;

        if ($level <= 2) {
            // return 'Creatures are filtered by hero\'s current level. We don\'t want you messing up with <strong>dragons</strong> too soon.';
            return 'As criaturas são filtradas de acordo com seu level. Não queremos você irritando dragões tão cedo.';
        }

        if ($level <= 5) {
            return 'As criaturas fracas sumirão quando você ficar mais forte.';
            // return 'Weak creatures will stop showing as you get stronger.';
        }

        return 'Você é um ótimo caçador. Não esqueça de fazer alguns amigos.';
        // return 'You are such a good hunter. Do not forget to make some friends.';
    }

    private function getMasteryTip()
    {
        $level = Auth::user()->level;

        if ($level == 1) {
            return 'Volte aqui quando atingir level 2.';
            // return 'Make sure to come back when you hit level 2.';
        }

        if ($level <= 2) {
            return 'Escolha uma habilidade e volte quando o treino estiver completo.';
            // return 'Choose what to master and come back later when you are ready.';
        }

        // return 'Masteries are important to tell what your character is capable of. Think twice when picking one of them.';
        return 'Habilidades são importantes para o desempenho do personagem. Pense duas vezes antes de escolher.';
    }
}
