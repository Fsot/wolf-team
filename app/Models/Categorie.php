<?php

namespace wolfteam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categorie extends Model
{
    protected $fillable = ['title', 'slug', 'type'];

    public function channels()
    {
        $this->hasMany(Channel::class);
    }

    public function setSlugAttribute()
    {
        return $this->attributes['slug'] = Str::slug($this->attributes['title']);
    }
}
