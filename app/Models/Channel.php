<?php

namespace wolfteam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Channel extends Model
{
    protected $fillable = ['title', 'slug','color', 'icon', 'block', 'categorie_id'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function setSlugAttribute($slug)
    {
        return $this->attributes['slug'] = Str::slug($this->attributes['title']);
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
