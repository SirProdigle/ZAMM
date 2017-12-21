<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

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

    public function MoveServer($serverNumber){

        try {
            if($serverNumber == $this->serverNumber){
                return "Server given is the server the mission is currently in. No changes have been made";
            }

            //Checking for different version of same file
            /*{
               $sameServerMissions =  Mission::where('serverNumber',$this->serverNumber);
                foreach ($sameServerMissions as $potentialMission){
                    if($potentialMission->GetFileNameWithoutVersion() == $this->GetFileNameWithoutVersion()){
                        //Same mission, different version, Throw error?
                        return "Server you are moving to has the same mission with a different version tag, Please remove the mission in that server. Moving has not been completed";
                    }
                }
            }
            //Checking for same file
            {
                If(Mission::where('serverNumber',$this->serverNumber)->where('fileName',$this->fileName)->exists()){
                    //We got same mission
                    return"This mission already exists on the designated server";
                }
            }*/

            rename(config('mission.directories')[$this->serverNumber] . '/' . $this->fileName, config('mission.directories')[$serverNumber] . '/' . $this->fileName);
            $this->serverNumber = $serverNumber;
            $this->save();
            return 'OK';
        }
        catch (\Exception $e){
            return 'File is currently locked. Please try again later.';
        }
    }

    private function GetFileNameWithoutVersion(){
        //TODO return the filename omitting the version tag
    }

}


