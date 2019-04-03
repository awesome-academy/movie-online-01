<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    public function film()
    {
        return $this->belongsTo('App\Film');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
