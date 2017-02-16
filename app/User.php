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

    public function hasNickname()
    {
        return $this->attributes['nickname'] != null;
    }

    public function getNicknameAttribute($value)
    {
        return $value ?: 'Andarilho Misterioso';
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
        return Creature::where('level', '>=', $this->level - 10)
            ->where('level', '<=', $this->level +1)
            ->orderBy('level')
            ->get();
    }

    public function getFancyNameAttribute()
    {
        return "<strong>{$this->nickname}</strong>";
    }

    public function getMeleeDefenceAttribute()
    {
        $selfDefence = ($this->self_defence_level * 0.2);
        $toughness = ($this->strength * $this->level * 0.15);

        $totalMeleeDefence = ceil($selfDefence + $toughness);

        return $totalMeleeDefence;
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
        $bonusPlusLevel = $this->getBonusDamage() + $this->level;
        $minRoll = $bonusPlusLevel;
        $maxRoll = $bonusPlusLevel * 2;

        $damage = rand($minRoll, $maxRoll);

        if ($damage == $maxRoll) {
            $damage *= 2;
        }

        $creatureDefence = $creature->armor;

        // Cause mages use magic
        if ($this->profession_id == 3) {
            $creatureDefence = $creature->magic_resistance;
        }

        $damage = $damage - $creatureDefence;

        $damage = $damage > 0 ? $damage : rand(1, 2);

        $creature->health -= $damage;

        return $damage;
    }

    public function getBonusDamage()
    {
        switch ($this->profession_id) {
            case 3: //Mage
                $damage = $this->secret_level;

                if ($this->current_mana >= 15) {
                    $manaPower = rand(1, $this->secret_level);

                    $this->current_mana -= 15;
                    $damage += $manaPower;
                }

                return $damage;
                break;
            case 4: //Hunter
                return $this->thievery_level;
                break;
            default: //Apprentice & Knight
                return $this->strength;
        }
    }

    public function dropStamina()
    {
        $this->current_stamina -= 5;

        return $this;
    }

    public function buyPotion($potionId, $amount = 1)
    {
        $potion = Potion::findOrFail($potionId);
        $totalCost = $potion->price * $amount;

        if ($this->gold >= $totalCost) {
            $this->gold -= $totalCost;

            $this->{$potion->field} += $amount;
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
                $this->current_health += $this->total_health * 0.4;
                break;
            case 2:
                $this->current_mana += $this->total_mana * 0.4;
                break;
            case 3:
                $this->current_stamina += $this->total_stamina * 0.4;
                break;

            default:
        }
    }

    public function levelUp()
    {
        $this->level += 1;
        $this->experience = 0;
        $this->mastery_points += 1;

        $healthPerLevel = 20;

        switch ($this->profession_id) {
            case 2:
                $healthPerLevel = 40;
                break;
            case 3:
                $healthPerLevel = 25;
                break;
            case 4:
                $healthPerLevel = 30;
                break;
        }

        $this->total_health = (8 * $this->strength) + ($healthPerLevel * $this->level);
        $this->total_mana = 15 * $this->secret_level;

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

        return "{$this->profession->name} {$this->getTitleName()}";
    }

    public function getTitleName($level = null)
    {
        $level = $level ?: $this->level;

        if ($level <= 9) return trans('titles.1');
        if ($level <= 19) return trans('titles.2');
        if ($level <= 29) return trans('titles.3');
        if ($level <= 39) return trans('titles.4');
        if ($level <= 49) return trans('titles.5');

        return trans('titles.6');
    }

    public function setExperienceAttribute($value)
    {
        $total = $this->level * 100;

        if ($value > $total) {
            $value = $total;
        }

        $this->attributes['experience'] = $value >= 0 ? $value : 0;
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
