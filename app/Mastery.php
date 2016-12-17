<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mastery extends Model
{
    public function getIconAttribute($value)
    {
        return url('/img/icons/' . $value);
    }
}
