<?php

namespace App\Timongo\Battle;

use App\Notifications\ArenaBattleDefeat;
use App\Notifications\ArenaBattleVictory;
use App\User;
use Carbon\Carbon;

class PvP
{
    public function battle(User $hero, User $opponent)
    {
        $rounds = [];

        while ($hero->stands() && $opponent->stands()) {
            $damage = $hero->strikes($opponent);

            array_push($rounds, [
                'message' => "{$hero->nickname} causou $damage de dano em {$opponent->nickname}",
                'hero'    => true,
            ]);

            if (!$opponent->stands()) {
                break;
            }

            $damage = $opponent->strikes($hero);

            array_push($rounds, [
                'message' => "{$opponent->nickname} causou $damage de dano em {$hero->nickname}",
                'hero'    => false,
            ]);

            if (!$hero->stands()) {
                break;
            }
        }

        $results = [];

        $results = $hero->stands() ? $this->battleWin($hero, $opponent) :
            $this->battleLoss($hero, $opponent);

        $hero->dropStaminaPvp()
            ->save();

        $opponent->save();

        return [
            'fight'   => $rounds,
            'results' => $results,
        ];
    }

    protected function battleWin($hero, $opponent)
    {
        $hero->arena_kills++;
        $opponent->arena_deaths++;

        $opponent->notify(new ArenaBattleDefeat($hero->nickname, Carbon::now()));

        $this->removeArenaSubscription($opponent);

        $opponent->current_health = $opponent->total_health * 0.4;

        $expEarned = 10 - abs($hero->level - $opponent->level);

        if ($hero->level < $opponent->level) {
            $expEarned += $opponent->level - $hero->level;
        }

        if ($guild = $hero->guild) {
            $guild->experience += $expEarned;
            $guild->save();
        }

        return [
            'message'   => "{$opponent->name} foi derrotado!",
            'win'       => true,
            'expEarned' => $guild ? $expEarned : 0,
        ];
    }

    protected function battleLoss($hero, $opponent)
    {
        $hero->arena_deaths++;
        $opponent->arena_kills++;

        $expEarned = 10 - abs($hero->level - $opponent->level);

        if ($opponent->level < $hero->level) {
            $expEarned += $hero->level - $opponent->level;
        }

        if ($guild = $opponent->guild) {
            $guild->experience += $expEarned;
            $guild->save();
        }

        $opponent->notify(new ArenaBattleVictory($hero->nickname, Carbon::now()));
        $this->removeArenaSubscription($hero);

        $hero->current_health = $hero->total_health * 0.4;

        return [
            'message' => 'Você foi derrotado!',
            'win'     => false,
        ];
    }

    private function removeArenaSubscription(User $user)
    {
        $user->arena()->detach();
    }
}
