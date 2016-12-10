<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potion extends Model
{
    public function getNameAttribute($value)
    {
        return trans('potions.' . $this->id);
    }
}
