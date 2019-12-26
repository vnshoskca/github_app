<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clear extends Model
{
    protected $table = 'clear';//テーブルとの紐つけ　[]あってはいけない

    protected $fillable = [
        'clear_flg', 'delete_flg', 'user_id', 'kostep_id', 'step_id'
    ]; //[]なくてはいけない
    //protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function kosteps(){
        return $this->belongsTo('App\Kostep');
    } 
}
