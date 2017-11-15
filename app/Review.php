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

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function  IsTextReview(){
        if($this->briefingDescription != "" ||
            $this->equipmentDescription != "" ||
            $this->enemyDescription != "" ||
            $this->locationDescription != ""||
            $this->objectivesDescription != ""||
            $this->enjoymentDescription != ""){
            return true;
        }
        else{
            return false;
        }
    }


}
