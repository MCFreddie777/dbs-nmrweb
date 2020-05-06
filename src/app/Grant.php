<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grant extends Model
{
    public $timestamps = false;

    public function scopeJoinSamplesTable($query)
    {
        return $query
            ->join('samples', 'samples.grant_id', '=', 'grants.id');
    }

    public function scopeSearch($query, $search)
    {
        return $query
            ->distinct()
            ->where('grants.name', 'like', '%' . $search . '%');
    }
}
