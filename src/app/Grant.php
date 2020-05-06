<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grant extends Model
{
    public $timestamps = false;

    public function samples()
    {
        return $this->hasMany('App\Sample');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'grant_user');
    }

    public function scopeOnlyMine($query, $id)
    {
        return $query
            ->leftjoin('grant_user', 'grant_user.user_id', '=', 'grants.id')
            ->where('grant_user.user_id', $id);
    }

    public function scopeJoinSamplesTable($query)
    {
        return $query
            ->leftjoin('samples', 'samples.grant_id', '=', 'grants.id');
    }

    public function scopeSearch($query, $search)
    {
        return $query
            ->distinct()
            ->where('grants.name', 'like', '%' . $search . '%');
    }
}
