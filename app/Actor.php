<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    public function films()
    {
        return $this->belongsToMany('App\Film');
    }
}
