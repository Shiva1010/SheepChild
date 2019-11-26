<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sort extends Model
{
    use Notifiable;

    protected $fillable=[
      'name',
    ];

    public function item()
    {
        // 不同的 nutrients 屬於同一種 flowers
        return $this->belongsTo('App\Item','sort_id','id');
    }

}
