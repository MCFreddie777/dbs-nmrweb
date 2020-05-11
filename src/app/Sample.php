<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    public $hidden = ['solvent_id', 'grant_id', 'user_id'];
    protected $fillable = ['name', 'amount', 'structure', 'solvent_id', 'grant_id', 'spectrometer_id', 'note'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function solvent()
    {
        return $this->belongsTo('App\Solvent');
    }

    public function grant()
    {
        return $this->belongsTo('App\Grant');
    }

    public function spectrometer()
    {
        return $this->belongsTo('App\Spectrometer');
    }

    public function analysis()
    {
        return $this->belongsTo('App\Analysis');
    }

    public function scopeJoinUsersTable($query)
    {
        return $query
            ->leftjoin('users', 'users.id', '=', 'samples.user_id');
    }

    public function scopeSearch($query, $search)
    {
        if (!$search) return $query;
        return $query
            ->distinct()
            ->where('users.login', 'like', '%' . $search . '%')
            ->orWhere('samples.id', 'like', '%' . $search . '%');
    }

    public function scopeOnlyMine($query, $id)
    {
        return $query
            ->where('samples.user_id', $id);
    }
}
