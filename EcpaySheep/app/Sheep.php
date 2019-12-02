<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Sheep extends Authenticatable implements MustVerifyEmail
{



    protected $guarded = [];

    use Notifiable;


    public function totals()
    {
        return $this->belongsToMany('App\Item')->withPivot('total');
    }


    protected $fillable=[
        'name','account','api_token','balance','password','score','email'
    ];

    protected $hidden=[
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function items()
    {
    	return $this->belongsToMany('App\Item')->withTimestamps();
    }

    public function secretItems()
    {
        return $this->belongsToMany('App\Item')->wherePivot(['item_name', 1]);
    }

}

