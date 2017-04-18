<?php

namespace wolfteam\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Thread extends Model
{
    protected $fillable = ['title', 'slug', 'channel_id', 'user_id', 'answer_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'thread_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function setSlugAttribute($slug)
    {
        return $this->attributes['slug'] = Str::slug($this->attributes['title']);
    }

    public function getCreatedAtAttribute($created)
    {
        Carbon::setLocale('fr');
            return Carbon::createFromFormat('Y-m-d H:i:s', $created)->diffForHumans();
    }
}
