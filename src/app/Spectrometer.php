<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spectrometer extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'type'];

    public function scopeSearch($query, $search)
    {
        return $query
            ->distinct()
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('type', 'like', '%' . $search . '%');
    }
}
