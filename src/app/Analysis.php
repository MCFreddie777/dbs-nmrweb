<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Analysis extends Model
{
    public function lab()
    {
        return $this->hasOne('App\Lab');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function status()
    {
        return DB::table('statuses')->where('id', $this->status_id)->first();
    }
}
