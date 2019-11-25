<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Wolf extends Authenticatable
{
    use Notifiable;
    protected $fillable=[
      'camp_name','account','api_token','balance','password'
    ];
    protected $hidden=[
      'password',
    ];

}
