<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solvent extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function scopeSearch($query, $search)
    {
        if (!$search) return $query;
        return $query
            ->distinct()
            ->where('name', 'like', '%' . $search . '%');
    }
}
