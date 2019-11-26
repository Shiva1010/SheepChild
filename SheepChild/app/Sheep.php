<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sheep extends Authenticatable
{

    protected $guarded = [];

    use Notifiable;

    public function totals()
    {
        return $this->belongsToMany('App\Item')->withPivot('total');
    }

    protected $fillable=[
        'name','account','api_token','balance','password','score'
    ];

    protected $hidden=[
        'password',
    ];

    public function items()
    {
    	return $this->belongsToMany('App\Item')->withTimestamps();
    }

}