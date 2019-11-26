<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

<<<<<<< HEAD
    public function items()
    {
    	return $this->belongsToMany('App\Sheep');
=======
    public function sort()
    {
        return $this->hasMany('App\Sort','id','sort_id');
>>>>>>> 8fa979a1951c469954c43285eaa25f6829aeab02
    }
}
