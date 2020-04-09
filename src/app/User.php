<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public $timestamps = false;
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function samples()
    {
        return $this->hasMany('App\Sample');
    }

    public function grants()
    {
        return $this->belongsToMany('App\Grant');
    }
}
