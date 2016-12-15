<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creature extends Model
{
    public function getImageAttribute($value)
    {
        return url('/img/creatures/' . $value);
    }

    public function getFancyNameAttribute()
    {
        return "<strong>{$this->name}</strong>";
    }

    public function stands()
    {
        return $this->health > 0;
    }

    public function strikes($hero)
    {
        $levelPlusAttack = $this->level + $this->attack;

        $minRoll = $levelPlusAttack * 0.5;
        $maxRoll = $levelPlusAttack;

        $damage = rand($minRoll, $maxRoll);

        // Critical hit
        if ($damage == $maxRoll) {
            $damage += $damage * 0.2;
        }

        $damage -= $hero->melee_defence;
        $damage = ($damage > 0) ? $damage : rand(1, 2);

        $hero->current_health -= $damage;

        return $damage;
    }

    public function getGoldDrop()
    {
        return rand(1, $this->gold);
    }
}
