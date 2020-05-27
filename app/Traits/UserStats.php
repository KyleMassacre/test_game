<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2020-03-02
 * Time: 03:06
 */

namespace App\Traits;

use App\Stat;
use App\StatUser;
use Illuminate\Support\Arr;
use App\Events\StatWasUpdated;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;


trait UserStats
{
    use HasRelationships;

    /**
     * @return mixed
     */
    public function stats()
    {
        return $this->belongsToMany(Stat::class)
            ->using(StatUser::class)
            ->withPivot(['value', 'max_value', 'updated_at', 'created_at']);
    }

    /**
     * @param string $statName
     * @return Stat
     */
    public function getStat($statName)
    {
        return $this->stats()->where('name', $statName)->first();
    }

    public function getExpRequiredAttribute()
    {
        return $this->getStat('Experience')->max_value;
    }

    public function getExpNeededAttribute()
    {
        return $this->expRequired - $this->getStat('Experience')->value;
    }

    public function saveStat($statName, $value = [])
    {
        $stat = $this->getStat($statName);
        $this->stats()->updateExistingPivot($stat->id, $value);

        event(new StatWasUpdated($this, $stat, Arr::get($value, 'value')));

    }

    public function LevelCalculator($level = null)
    {
        $result = 0;

        $config = config()->get('core.level_calculator');

        $pattern = "/{(.+?)}/";


        preg_match($pattern, $config, $matches);

        if(!$level)
        {
            $matches = preg_replace_callback($pattern, function($matches) use ($pattern) {
                return str_ireplace($matches[0], '', $this->getStat($matches[1])->value);
            }, $config);
        }
        else
        {
            $matches = preg_replace_callback($pattern, function($matches) use ($pattern, $level) {
                return str_ireplace($matches[0], '', $level);
            }, $config);
        }

        eval('$result = '.$matches.';');

        return $result;
    }
}
