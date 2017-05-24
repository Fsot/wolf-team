<?php

namespace wolfteam\Models;

use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    protected $fillable = ['user_id', 'login_time', 'login_ip', 'browser_agent', 'success'];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
