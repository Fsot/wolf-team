<?php

namespace wolfteam\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{

    protected $fillable = ['user_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
