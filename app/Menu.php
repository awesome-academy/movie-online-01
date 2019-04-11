<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = ['id'];
    
    public function films()
    {
        return $this->belongsToMany('App\Film');
    }

    public function childMenu()
    {
    	return $this->hasMany('App\Menu', 'parent_id');
    }
}
