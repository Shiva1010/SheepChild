<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Base extends Model
{
    use Notifiable;

    protected $fillable=[
        'camp','userID','password','key','account','amount','isShop'
    ];
}
