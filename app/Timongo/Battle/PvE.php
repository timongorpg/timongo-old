<?php

namespace App\Timongo\Battle;

use Auth;
use App\Creature;

class PvE {

    protected $creatures;

    public function __construct(Creature $creatures)
    {
        $this->creatures = $creatures;
    }

    public function battle($creature_id)
    {
        $hero     = Auth::user();
        $opponent = $this->getCreature($creature_id);

        $rounds = [];

        while( $hero->stands() && $opponent->stands() ){
            $damage = $hero->strikes($opponent);

            array_push($rounds, [
                'message' => "{$hero->fancyName} causes $damage to {$opponent->fancyName}",
                'hero' => true
            ]);

            if (! $opponent->stands()) break;

            $damage = $opponent->strikes($hero);

            array_push($rounds, [
                'message' => "{$opponent->fancyName} causes $damage to {$hero->fancyName}",
                'hero' => false
            ]);

            if (! $hero->stands()) break;
        }

        $results = [];

        if ($hero->stands()) {
            $results = $this->battleWin($hero, $opponent);
        }

        if ($opponent->stands()) {
            $results = $this->battleLoss($hero, $opponent);
        }

        $hero->dropStamina()
            ->save();

        return [
            'fight' => $rounds,
            'results' => $results
        ];
    }

    protected function battleWin($hero, $opponent)
    {
        $goldDrop = $opponent->getGoldDrop();
        $hero->experience += $opponent->experience;
        $hero->gold += $goldDrop;

        return [
            'message' => "{$opponent->name} is dead!",
            'win' => true,
            'experience' => $opponent->experience,
            'gold' => $goldDrop
        ];
    }

    protected function battleLoss($hero, $opponent)
    {
        $hero->experience -= round($hero->experience * 0.2);

        $hero->current_health = $hero->total_health * 0.2;

        return [
            'message' => 'You have fainted!',
            'win' => false,
            'gold' => 0
        ];
    }

    protected function getCreature($creatureId)
    {
        return $this->creatures->find($creatureId);
    }
}