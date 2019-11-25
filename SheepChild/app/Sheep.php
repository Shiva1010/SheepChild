<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sheep extends Authenticatable
{
<<<<<<< HEAD
    protected $guarded = [];
=======
    use Notifiable;
    protected $fillable=[
        'name','account','api_token','balance','password'
    ];
    protected $hidden=[
        'password',
    ];
>>>>>>> ed4bb67d0cc4ccde11077c9692bc6bc912ae9b9f
}
