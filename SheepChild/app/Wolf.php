<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Wolf extends Model
{
    use Notifiable;
    protected $fillable=[
      'camp_name','account','api_token','balance'
    ];
    protected $hidden=[
      'password',
    ];

}
