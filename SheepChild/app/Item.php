<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];


    public function items()
    {

        return $this->belongsToMany('App\Sheep');

    }

    public function sort()
    {
        return $this->hasMany('App\Sort','id','sort_id');

    }
}
