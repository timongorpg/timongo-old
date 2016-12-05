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
        $damage = ceil($this->attack * 0.2 + (rand(1, $this->level) * 0.3));
        $hero->current_health -= $damage;

        return $damage;
    }

    public function getGoldDrop()
    {
        return rand(1, $this->gold);
    }
}
