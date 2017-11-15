<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MissionRequest extends Model
{
    //

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
