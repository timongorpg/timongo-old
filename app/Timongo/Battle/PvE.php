<?php

namespace App\Timongo\Battle;

use App\Creature;
use Auth;

class PvE
{
    protected $creatures;

    public function __construct(Creature $creatures)
    {
        $this->creatures = $creatures;
    }

    public function battle($creatureId)
    {
        $hero = Auth::user();
        $opponent = $this->getCreature($creatureId);

        $rounds = [];
        $summary = [
            'hero_total_damage'     => 0,
            'opponent_total_damage' => 0,
        ];

        while ($hero->stands() && $opponent->stands()) {
            $damage = $hero->strikes($opponent);

            array_push($rounds, [
                'message' => "{$hero->fancyName} causou $damage de dano em {$opponent->fancyName}",
                'hero'    => true,
            ]);

            $summary['hero_total_damage'] += $damage;

            if (!$opponent->stands()) {
                break;
            }

            $damage = $opponent->strikes($hero);

            array_push($rounds, [
                'message' => "{$opponent->fancyName} causou $damage de dano em {$hero->fancyName}",
                'hero'    => false,
            ]);

            $summary['opponent_total_damage'] += $damage;

            if (!$hero->stands()) {
                break;
            }
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
            'fight'   => $rounds,
            'results' => $results,
            'summary' => $summary,
        ];
    }

    protected function battleWin($hero, $opponent)
    {
        $goldDrop = $this->getGoldDrop($hero, $opponent);
        $expEarned = $this->getExpEarned($hero, $opponent);

        $hero->experience += $expEarned;
        $hero->gold += $goldDrop;

        return [
            'message'    => "{$opponent->name} foi derrotado!",
            'win'        => true,
            'experience' => $expEarned,
            'gold'       => $goldDrop,
        ];
    }

    protected function battleLoss($hero, $opponent)
    {
        $hero->experience -= round($hero->experience * 0.2);

        $hero->current_health = $hero->total_health * 0.4;

        return [
            'message' => 'Você foi derrotado!',
            'win'     => false,
            'gold'    => 0,
        ];
    }

    private function getExpEarned($hero, $opponent)
    {
        if (!$hero->isMaxLevel()) {
            $learningLevelBonus = $opponent->experience * 0.04 * $hero->learning_level;
            $expEarned = $opponent->experience + $learningLevelBonus;

            if ($hero->level >= ($opponent->level + 5)) {
                $expEarned = $expEarned / 3;
            }

            return (int) round($expEarned);
        } else {
            return 0;
        }
    }

    private function getGoldDrop($hero, $opponent)
    {
        $base = $opponent->getGoldDrop();
        $thieveryLevelBonus = $base * 0.05 * $hero->thievery_level;
        $luckLevelBonus = 0;

        if (rand(0, 100) < $hero->luck_level) {
            $luckLevelBonus = $base * 0.15 * $hero->luck_level;
        }

        $goldDrop = $base + $thieveryLevelBonus + $luckLevelBonus;

        return (int) round($goldDrop);
    }

    protected function getCreature($creatureId)
    {
        return $this->creatures->find($creatureId);
    }
}
