<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    protected $guarded=[];
    //
    public function  mission(){
        return $this->belongsTo('App\Mission');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

}
