<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Twitter extends Model
{
    protected $table = 'twitter';//テーブルとの紐つけ　[]あってはいけない

    protected $fillable = [
        'twitter_flg', 'delete_flg', 'user_id', 'step_id'
    ]; //[]なくてはいけない
    //protected $guarded = [];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function steps(){
        return $this->belongsTo('App\Step');
    }
}
