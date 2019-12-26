<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kostep extends Model
{
    protected $fillable = [
        'content', 'detail_content', 'cleared_flg', 'delete_flg', 'step_id', 'user_id'
    ];
    //protected $guarded = [];

    public function steps(){
        return $this->belongsTo('App\Step');
    }
    public function clear(){
        return $this->hasMany('App\Clear');
    }
    /*
    public function user(){
        return $this->belongsToMany('App\User');
    }
    */
}
