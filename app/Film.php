<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchFullText;

class Film extends Model
{
    use SearchFullText;

    protected $fillable = [
        'user_id',
        'title_en',
        'title_vn',
        'slug',
        'thumb',
        'director',
        'country_id',
        'year',
        'duration',
        'description',
        'trailer',
        'language',
        'quality',
    ];

    protected $searchable = [
        'title_en',
        'title_vn',
        'director',
    ];
    
    public function actors()
    {
        return $this->belongsToMany('App\Actor');
    }

    public function users()
    {
    	return $this->belongsToMany('App\User', 'saves');
    }

    public function saves()
    {
        return $this->hasMany('App\Save');
    }
    
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function episodes()
    {
        return $this->hasMany('App\Episode');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function menus()
    {
        return $this->belongsToMany('App\Menu');
    }

    public function uploadByUser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
