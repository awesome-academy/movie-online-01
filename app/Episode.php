<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public function film()
    {
        return $this->belongsTo('App\Film');
    }
}
