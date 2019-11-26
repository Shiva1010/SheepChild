<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function sort()
    {
        return $this->hasMany('App\Sort','id','sort_id');
    }
}
