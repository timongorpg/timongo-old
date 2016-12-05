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
        $damage = ceil($this->attack + (rand($this->level * 0.3, $this->level) * 0.3));
        $damage -= $hero->melee_defence;

        $hero->current_health -= $damage;

        return $damage;
    }

    public function getGoldDrop()
    {
        return rand(1, $this->gold);
    }
}
