<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $guarded=[];

    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function  reviews(){
        return $this->hasMany('App\Review');
    }
    public function  bugs(){
        return $this->hasMany('App\Bug');
    }

}


