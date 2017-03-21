<?php

namespace App\Timongo\Battle;

use Auth;
use App\User;

class PvP
{
    public function battle(User $hero, User $opponent)
    {
        $rounds = [];

        while( $hero->stands() && $opponent->stands() ){
            $damage = $hero->strikes($opponent);

            array_push($rounds, [
                'message' => "{$hero->nickname} causou $damage de dano em {$opponent->nickname}",
                'hero' => true
            ]);

            if (! $opponent->stands()) break;

            $damage = $opponent->strikes($hero);

            array_push($rounds, [
                'message' => "{$opponent->nickname} causou $damage de dano em {$hero->nickname}",
                'hero' => false
            ]);

            if (! $hero->stands()) break;
        }

        $results = [];

        $results = $hero->stands() ? $this->battleWin($hero, $opponent) :
            $this->battleLoss($hero, $opponent);

        $hero->dropStaminaPvp()
            ->save();

        $opponent->save();

        return [
            'fight' => $rounds,
            'results' => $results
        ];
    }

    protected function battleWin($hero, $opponent)
    {
        $hero->arena_kills++;
        $opponent->arena_deaths++;

        $this->removeArenaSubscription($opponent);

        $opponent->current_health = $opponent->total_health * 0.4;


        // $goldDrop = $opponent->getGoldDrop();
        // $expEarned = ceil(($opponent->experience) + ($opponent->experience * 0.05 * $hero->learning_level));

        // if ($hero->level >= ($opponent->level + 5)) {
        //     $expEarned /= 3;
        // }

        // $hero->experience += intval($expEarned);
        // $hero->gold += $goldDrop;

        return [
            'message' => "{$opponent->name} foi derrotado!",
            'win' => true
        ];
    }

    protected function battleLoss($hero, $opponent)
    {
        $hero->arena_deaths++;
        $opponent->arena_kills++;

        $this->removeArenaSubscription($hero);

        $hero->current_health = $hero->total_health * 0.4;

        return [
            'message' => 'Você foi derrotado!',
            'win' => false,
        ];
    }

    private function removeArenaSubscription(User $user)
    {
        $user->arena()->detach();
    }
}