<?php

namespace wolfteam\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['value', 'name'];

    public $timestamps = false;
}
