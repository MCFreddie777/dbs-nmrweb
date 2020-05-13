<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Analysis extends Model
{
    public function lab()
    {
        return $this->belongsTo('App\Lab');
    }

    public function sample()
    {
        return $this->hasOne('App\Sample');
    }

    public function laborant()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function status()
    {
        return DB::table('statuses')->where('id', $this->status_id)->first();
    }

    public function scopeJoinSamplesTable($query)
    {
        return $query
            ->leftjoin('samples', 'samples.analysis_id', '=', 'analyses.id');
    }

    public function scopeJoinStatusesTable($query)
    {
        return $query
            ->leftjoin('statuses', 'statuses.id', '=', 'analyses.status_id');
    }

    public function scopeJoinUsersTable($query)
    {
        return $query
            ->leftjoin('users', 'users.id', '=', 'analyses.user_id');
    }

    public function scopeSearch($query, $search)
    {
        if (!$search) return $query;
        return $query
            ->distinct()
            ->where('samples.name', 'like', '%' . $search . '%')
            ->orWhere('users.login', 'like', '%' . $search . '%');
    }

    public function scopeOnlyMine($query, $id)
    {
        return $query
            ->where('samples.user_id', $id);
    }
}
