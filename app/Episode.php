<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
	protected $guarded = ['id'];
	
    public function film()
    {
        return $this->belongsTo('App\Film');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
    }
}
