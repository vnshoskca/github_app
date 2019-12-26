<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'email', 'password', 'image', 'introduction' ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token', ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
      }
      /**
       * Return a key value array, containing any custom claims to be added to the JWT.
       *
       * @return array
       */
      public function getJWTCustomClaims()
      {
        return [];
      }

      /**
     * Override the mail body for reset password notification mail.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    }
    
    public function steps(){
        return $this->hasMany('App\Step');
    }
    public function challenge(){
        return $this->hasMany('App\Challenge');
    }
    public function twitter(){
        return $this->hasMany('App\Twitter');
    }
    public function clear(){
        return $this->hasMany('App\Clear');
    }
    public function category(){
        return $this->belongsToMany('App\Category');
    }
    public function kosteps(){
        return $this->hasManyThrough(
            'App\Kostep',
            'App\Step'
        );
    }
}
