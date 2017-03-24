<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    public function getNameAttribute($value)
    {
        return trans('professions.'.$this->id);
    }
}
