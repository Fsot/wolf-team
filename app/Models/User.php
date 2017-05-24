<?php

namespace wolfteam\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Cog\Ban\Contracts\HasBans as HasBansContract;
use Cog\Ban\Traits\HasBans;

class User extends Authenticatable implements HasBansContract
{
    use Notifiable;
    use EntrustUserTrait;
    use HasBans;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_token', 'profil_id','user_ip'
    ];
    protected $dates = ['created_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function threads()
    {
        $this->hasMany(Thread::class);
    }

    public function profil()
    {
        return $this->hasOne(Profil::class);
    }

    public function logins()
    {
        return $this->hasMany(LoginAttempt::class);
    }

    public function getCreatedAtAttribute($created)
    {
        if($created)
        {
            return Carbon::createFromFormat('Y-m-d H:i:s', $created)->diffForHumans();
        }
    }
}
