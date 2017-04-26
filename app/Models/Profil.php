<?php

namespace wolfteam\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class Profil extends Model
{

    protected $fillable = ['user_id', 'firstname', 'lastname', 'avatar'];

    protected $dates = ['birthday'];

    protected function getImageDir(){

        $link = public_path('users');
        $target = storage_path('app/public');
        if(!file_exists($link)){
            symlink($target, $link);
        }
        return '/avatars/';
    }

    protected function getAvatarName(){
        return \Auth::user()->name;
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function setBirthdayAttribute($birth)
    {
        if($birth){
            return $this->attributes['birthday'] = Carbon::createFromFormat('d/m/Y', $birth)->format('Y-m-d');
        }
    }

    public function getBirthdayAttribute($birth)
    {
        if($birth){
            return Carbon::createFromFormat('Y-m-d', $birth)->format('d/m/Y');
        }
    }

    public function setAvatarAttribute($avatar){
        if(is_object($avatar) && $avatar->isValid()){
            if(!empty($this->files))
            {
                unlink($this->getImageDir() . "/{$this->id}.{$this->files}");
            }
            self::saved(function($instance) use ($avatar){
                $name = $this->getAvatarName();
                Storage::disk('public')->makeDirectory($instance->getImageDir(), 0777);
                ImageManagerStatic::make($avatar)->fit(100, 100)->save(storage_path('app/public/' . $instance->getImageDir() . $name . '.png'));
            });
            return $this->attributes['avatar'] = true;
        }
        $this->attributes['avatar'] = false;
    }

    public function avatar($user = null)
    {
        if($user == true){
            if (file_exists(storage_path('app/public'. $this->getImageDir() . $user . '.png'))){
                return asset('users/avatars/' . $user .  '.png');
            }else{
                return 'https://www.gravatar.com/avatar/'.md5($user);
            }
        }
    }
}



/*toDisplay: function (date, format, language) {
    var d = new Date(date);
    var dd=d.getDate();
    var mm=d.getMonth()+1;
    var yy=d.getFullYear();
    var newdate=dd+"/"+mm+"/"+yy;
    return newdate;
},
toValue: function (date, format, language) {
    var d = new Date(date);
    var dd=d.getDate();
    var mm=d.getMonth()+1;
    var yy=d.getFullYear();
    var newdate=dd+"/"+mm+"/"+yy;
    return new Date(newdate);
}*/
