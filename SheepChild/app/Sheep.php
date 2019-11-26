<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sheep extends Authenticatable
{

    protected $guarded = [];

    use Notifiable;
<<<<<<< HEAD

=======
    protected $fillable=[
        'name','account','api_token','balance','password','score'
    ];
>>>>>>> 8fa979a1951c469954c43285eaa25f6829aeab02
    protected $hidden=[
        'password',
    ];

    public function items()
    {
    	return $this->belongsToMany('App\Item');
    }

}
