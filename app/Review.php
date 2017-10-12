<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $guarded=[];

    public function  mission(){
        return $this->belongsTo('App\Mission');
    }


}
