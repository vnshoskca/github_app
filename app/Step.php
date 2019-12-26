<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = [
        'title', 'achievement_time', 'challenged_flg', 'twitter_flg ', 'delete_flg', 'user_id', 'category_id'
    ];
    //protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
        //return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function kosteps(){
        return $this->hasMany('App\Kostep');
    }
    public function challenge(){
        return $this->hasMany('App\Challenge');
    }
    public function twitter(){
        return $this->hasMany('App\Twitter');
    }
    public function clear(){
        return $this->hasManyThrough(
            'App\Clear',
            'App\Kostep'
        );
    }
}
