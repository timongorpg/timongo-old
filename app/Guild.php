<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    protected $fillable = [
        'name',
        'leader_id',
    ];

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function leader()
    {
        return $this->hasOne(User::class, 'id', 'leader_id');
    }
}
