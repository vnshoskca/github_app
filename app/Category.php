<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';//テーブルとの紐つけ　[]あってはいけない

    protected $fillable = ['name']; //[]なくてはいけない
    //protected $guarded = [];

    public function steps(){
        return $this->hasMany('App\Step');
    }
    public function kosteps(){//祖父母と孫の関係
        return $this->hasManyThrough(
            'App\Kostep',
            'App\Step'
        );
    }
    public function user(){
        return $this->belongsToMany('App\User');
    }  
}
