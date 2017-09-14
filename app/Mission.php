<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

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

    public function hasAuthorID($id){
        try {
            return $this->user->id == $id;
        }
        catch (QueryException $e){
            return false;
        }
    }

}


