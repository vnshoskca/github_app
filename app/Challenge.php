<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $table = 'challenge';//テーブルとの紐つけ　[]あってはいけない

    protected $fillable = [
        'challenge_flg', 'delete_flg', 'user_id', 'step_id'
    ]; //[]なくてはいけない
    //protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function steps(){
        return $this->belongsTo('App\Step');
    } 
}
