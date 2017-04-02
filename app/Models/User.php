<?php

namespace wolfteam\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_token', 'profil_id',
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

    public function profil()
    {
        return $this->hasOne(Profil::class);
    }

    public function getCreatedAtAttribute($created)
    {
        return Carbon::createFromFormat('Y-m-d H:m:s', $created)->diffForHumans();
    }
}
