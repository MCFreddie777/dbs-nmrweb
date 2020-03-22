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
}
