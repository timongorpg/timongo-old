<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    protected $fillable = [
        'name',
        'leader_id',
        'experience',
    ];

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function leader()
    {
        return $this->hasOne(User::class, 'id', 'leader_id');
    }

    public function candidates()
    {
        return $this->belongsToMany(User::class, 'guild_candidates')
            ->withTimestamps();
    }

    public function hasEnoughExperience()
    {
        return $this->experience >= $this->toNextLevel();
    }

    public function toNextLevel()
    {
        return $this->level * 1000;
    }

    public function levelUp()
    {
        $this->level += 1;
        $this->experience = 0;

        return $this;
    }

    public function getExperiencePercentageAttribute()
    {
        return round($this->experience / ($this->level * 1000) * 100);
    }
}
