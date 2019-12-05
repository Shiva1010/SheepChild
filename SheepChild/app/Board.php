<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Board extends Model
{
    use Notifiable;
    protected $fillable=[
       'sheep_id','sheep_msg','wolf_id','wolf_msg',
    ];

    public function sheep()
    {
        return $this->belongsToMany('App\Sheep');
    }
}
