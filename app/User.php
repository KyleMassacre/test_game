<?php

namespace App;

use App\Traits\UserStats;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Modules\Mail\Entities\HasInbox;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, UserStats, HasRoles, HasInbox;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_action' => 'datetime',
    ];

    public function scopeIsOnline(Builder $query)
    {
        return $query->where(function (Builder $query) {
            $query->where('last_action', '>', Carbon::make(now())->subMinutes(env('SESSION_LIFETIME')));
        });
    }

    public function getIsOnlineAttribute()
    {
        if($this->last_action)
        {
            return $this->last_action->greaterThanOrEqualTo(Carbon::make(now())->subMinutes(env('SESSION_LIFETIME')));
        }
        else {
            return false;
        }
    }
}
