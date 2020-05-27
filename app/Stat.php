<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\StatWasUpdated;

class Stat extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];


    public function users()
    {
        return $this->belongsToMany(User::class)->using(StatUser::class)
            ->withPivot(['value', 'max_value', 'updated_at', 'created_at']);
    }

    public function getValueAttribute()
    {
        switch ($this->display_type) {
            case 'integer':
                return (int)$this->pivot->value;
                break;
            case 'boolean':
                return (bool)$this->pivot->value;
                break;
            case 'float':
                return (float)$this->pivot->value;
                break;
            case 'string':
            case 'text':
                return (string)$this->pivot->value;
            default:
                return $this->pivot->value;
        }

    }

    public function getMaxValueAttribute()
    {
        if($this->pivot->max_value == null)
        {
            return null;
        }
        switch ($this->display_type) {
            case 'integer':
                return (int)$this->pivot->max_value;
                break;
            case 'boolean':
                return (bool)$this->pivot->max_value;
                break;
            case 'float':
                return (float)$this->pivot->max_value;
                break;
            case 'string':
            case 'text':
                return (string)$this->pivot->max_value;
            default:
                return $this->pivot->max_value;
        }
    }

    public function add($value)
    {
        $user = User::find($this->pivot->user_id);

        if($updated = $this->users()->updateExistingPivot($user->id, ['value' => $this->pivot->value += $value]))
        {
            event(new StatWasUpdated($user, $this, $value));
        }

        return $updated;

    }

    public function subtract($value)
    {
        $user = User::find($this->pivot->user_id);

        if($updated = $this->users()->updateExistingPivot($user->id, ['value' => $this->pivot->value -= $value]))
        {
            event(new StatWasUpdated($user, $this, $value));
        }

        return $updated;
    }

    public function getPercentageAttribute()
    {
        if($this->pivot->max_value != null)
        {
            return round(($this->pivot->value / $this->pivot->max_value) * 100, 0);
        }
        else
        {
            return null;
        }
    }

    public function getFormattedAttribute()
    {
        if($this->attributes['formatter'] != null)
        {
            return call_user_func_array($this->formatter, [$this]);
        }
        else
        {
            return $this->pivot->value;
        }
    }

}
