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
    public function GetOverallScore(){
        return ($this->reviews()->avg('briefing')+
            $this->reviews()->avg('equipment')+
            $this->reviews()->avg('enemy')+
            $this->reviews()->avg('location')+
            $this->reviews()->avg('objectives')+
            $this->reviews()->avg('enjoyment'))/6;
    }

}


