<?php

namespace wolfteam\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['text' , 'user_id', 'thread_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getCreatedAtAttribute($created)
    {
        Carbon::setLocale('fr');
        return Carbon::createFromFormat('Y-m-d H:i:s', $created)->diffForHumans();
    }
}
