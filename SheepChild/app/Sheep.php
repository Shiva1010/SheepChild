<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sheep extends Authenticatable
{

    protected $guarded = [];

    use Notifiable;

    protected $hidden=[
        'password',
    ];

    public function items()
    {
    	return $this->belongsToMany('App\Item');
    }

}
