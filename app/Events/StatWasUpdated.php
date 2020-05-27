<?php

namespace App\Events;

use App\Stat;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StatWasUpdated implements ShouldBroadcast
{
    use SerializesModels, InteractsWithSockets;

    public $user;

    public $stat;

    public $amount;

    public $message;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Stat $stat
     * @param $amount
     * @param null $message
     */
    public function __construct(User $user, Stat $stat, $amount, $message = null)
    {
        $this->user = $user;
        $this->stat = $stat;
        $this->amount = $amount;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.User.StatChanged.'. $this->user->id);
    }
}
