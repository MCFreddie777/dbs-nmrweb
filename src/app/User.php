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

    public function analyses()
    {
        return $this->hasMany('App\Sample');
    }

    public function grants()
    {
        return $this->belongsToMany('App\Grant');
    }

    /**
     * Checks if user has role in the parameter
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role->name === $role;
    }

    public function scopeJoinRolesTable($query)
    {
        return $query
            ->join('roles', 'roles.id', '=', 'users.role_id');
    }

    public function scopeJoinSamplesTable($query)
    {
        return $query
            ->join('samples', 'samples.user_id', '=', 'users.id');
    }

    public function scopeSearch($query, $search)
    {
        return $query
            ->distinct()
            ->where('users.login', 'like', '%' . $search . '%')
            ->orWhere('roles.name', 'like', '%' . $search . '%');
    }
}
