<?php

namespace App\Listeners;

use App\Events\StatWasUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleUserLevel
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param StatWasUpdated $event
     * @return void
     */
    public function handle(StatWasUpdated $event)
    {
        $user = $event->user;
        $stat = $event->stat;

        if($stat->name == 'Experience') {

            while ($user->getStat('Experience')->value >= $user->LevelCalculator()) {
                $level = $user->getStat('Level');
                $level->add(1);
                if ($user->getStat('Experience')->value < $user->LevelCalculator()) {
                    /**
                     * Don't want to use the `saveStat()` method here because
                     * we are already using it to get to this point in updating
                     * the user's Experience to get them to how much experience they
                     * actually have left. No need to check to see if they have leveled
                     * up again
                     */
                    event(new StatWasUpdated($user, $level, $level->value, 'You just leveled up to Level '.$level->value));
                    $user->stats()->updateExistingPivot($stat->id, [
                        'value' => (int)$user->getStat('Experience')->value - (int)$user->LevelCalculator($level->value - 1),
                        'max_value' => (int)$user->LevelCalculator()
                    ]);
                }
            }
        }

        if($event->stat->name == 'Level')
        {
            $healhStat = $user->getStat('Health');
            $moneyStat = $user->getStat('Money');
            $user->saveStat('Health', [
                'value' => $healhStat->max_value + 50,
                'max_value' => $healhStat->max_value + 50
            ]);
            $user->saveStat('Money', ['value' => $moneyStat->value + 100]);

        }
    }
}
