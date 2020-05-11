<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    public $timestamps = false;
    protected $fillable = ['address', 'name'];

    public function scopeSearch($query, $search)
    {
        if (!$search) return $query;
        return $query
            ->distinct()
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('address', 'like', '%' . $search . '%');
    }
}
