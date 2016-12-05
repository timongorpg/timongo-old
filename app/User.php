<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    protected $dates = [
        'end_training'
    ];

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function getExperiencePercentageAttribute()
    {
        return round($this->experience / ($this->level * 100) * 100);
    }

    public function getHealthPercentageAttribute()
    {
        return round($this->current_health / $this->total_health * 100);
    }

    public function getManaPercentageAttribute()
    {
        return round($this->current_mana / $this->total_mana * 100);
    }

    public function getStaminaPercentageAttribute()
    {
        return round($this->current_stamina / $this->total_stamina * 100);
    }

    public function getOpponents()
    {
        return Creature::where('level', '>=', $this->level -3)
            ->where('level', '<=', $this->level +3)
            ->get();
    }

    public function getFancyNameAttribute()
    {
        return "<strong>{$this->name}</strong>";
    }

    public function getMeleeDefenceAttribute()
    {
        return ($this->strength * 0.3) + ($this->level * 0.3)
            * ($this->self_defence_level * 0.2);
    }

    public function hasEnoughExperience()
    {
        return $this->experience >= $this->toNextLevel();
    }

    public function toNextLevel()
    {
        return ($this->level * 100);
    }

    public function stands()
    {
        return $this->current_health > 0;
    }

    public function strikes($creature)
    {
        $roll = rand(1, 6);

        if ($roll == 6) {
            $roll *= 2;
        }

        $damage = ceil($this->strength * 0.2 + ($roll * 0.5));
        $creature->health -= $damage;

        return $damage;
    }

    public function dropStamina()
    {
        $this->current_stamina -= 6;

        return $this;
    }

    public function buyPotion($potionId)
    {
        $potion = Potion::findOrFail($potionId);

        if ($this->gold >= $potion->price) {
            $this->gold -= $potion->price;

            $this->{$potion->field}++;
        }

        return $this;
    }

    public function usePotion($potionId)
    {
        $potion = Potion::findOrFail($potionId);

        if ($this->{$potion->field} >= 1) {
            $this->{$potion->field}--;

            $this->applyPotionEffect($potion);
        }

        return $this;
    }

    protected function applyPotionEffect(Potion $potion)
    {
        switch ($potion->id) {
            case 1:
                $this->current_health += $this->total_health * 0.3;
                break;
            case 2:
                $this->current_mana += $this->total_mana * 0.3;
                break;
            case 3:
                $this->current_stamina += $this->total_stamina * 0.3;
                break;

            default:
        }
    }

    public function levelUp()
    {
        $this->level += 1;
        $this->experience = 0;
        $this->mastery_points += 1;

        $this->current_health = $this->total_health;
        $this->current_stamina = $this->total_stamina;
        $this->current_mana = $this->total_mana;

        return $this;
    }

    public function isTraining($masteryId = false)
    {
        if ($masteryId) {
            return $this->training_mastery == $masteryId && $this->end_training;
        }

        return $this->training_mastery && $this->end_training;
    }

    public function trainFinished()
    {
        return $this->training_mastery && $this->end_training <= Carbon::now();
    }

    public function finishTrain()
    {
        $mastery = Mastery::findOrFail($this->training_mastery);

        $this->training_mastery = null;
        $this->end_training = null;

        $this->{$mastery->field}++;

        return $this;
    }

    public function startTraining($masteryId)
    {
        $mastery = Mastery::findOrFail($masteryId);

        $this->training_mastery = $mastery->id;

        $masteryLevel = $this->{$mastery->field};
        $duration = 30 + (15 * $masteryLevel);

        $this->end_training = Carbon::now()->addSeconds($duration);

        return $this;
    }

    public function getProfessionName()
    {
        if ($this->profession->id == 1) {
            return $this->profession->name;
        }

        return "{$this->getTitleName()} {$this->profession->name}";
    }

    public function getTitleName($level = null)
    {
        $level = $level ?: $this->level;

        if ($level <= 9) return 'Apprentice';
        if ($level <= 19) return 'Initiate';
        if ($level <= 29) return 'Journeyman';
        if ($level <= 39) return 'Adept';
        if ($level <= 49) return 'Veteran';

        return 'Lord';
    }

    public function setCurrentHealthAttribute($value)
    {
        if ($value > $this->total_health) {
            $value = $this->total_health;
        }

        $this->attributes['current_health'] = $value >= 0 ? $value : 0;
    }

    public function setCurrentManaAttribute($value)
    {
        if ($value > $this->total_mana) {
            $value = $this->total_mana;
        }

        $this->attributes['current_mana'] = $value >= 0 ? $value : 0;
    }

    public function setCurrentStaminaAttribute($value)
    {
        if ($value > $this->total_stamina) {
            $value = $this->total_stamina;
        }

        $this->attributes['current_stamina'] = $value >= 0 ? $value : 0;
    }
}
