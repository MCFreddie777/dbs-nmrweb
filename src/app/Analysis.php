<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    public function lab()
    {
        $this->hasOne('App\Lab');
    }
}
