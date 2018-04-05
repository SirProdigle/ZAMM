<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class Mission extends Model
{
    protected $guarded = [];

    //


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function bugs()
    {
        return $this->hasMany('App\Bug');
    }

    public function hasAuthorID($id)
    {
        try {
            return $this->user->id == $id;
        } catch (QueryException $e) {
            return false;
        }
    }

    public function GetOverallScore()
    {
        return ($this->reviews()->avg('briefing') +
                $this->reviews()->avg('equipment') +
                $this->reviews()->avg('enemy') +
                $this->reviews()->avg('location') +
                $this->reviews()->avg('objectives') +
                $this->reviews()->avg('enjoyment')) / 6;
    }

    public function MoveServer($serverNumber)
    {

        try {
            if ($serverNumber == $this->serverNumber) {
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
        } catch (\Exception $e) {
            return 'File is currently locked. Please try again later.';
        }
    }

    private function GetFileNameWithoutVersion()
    {
        //TODO return the filename omitting the version tag
    }


    static function GetAllIslands()
    {
        return Mission::select('island')->distinct()->where('island', '!=', '')->orderBy('island')->get();
    }

    static function GetAllFactions()
    {
        $factions = Mission::select('friendlyFaction')->distinct()->where('friendlyFaction', '!=', '')->orderBy('friendlyFaction')->get();
        return $factions;
    }

    static function GetAllSupportAssets()
    {
        return Mission::select('friendlySupportAssets')->distinct()->where('friendlySupportAssets', '!=', '')->orderBy('friendlySupportAssets')->get();
    }

    static function GetAllOrbatTypes()
    {
        return Mission::select('friendlyOrbatType')->distinct()->where('friendlyOrbatType', '!=', '')->orderBy('friendlyOrbatType')->get();
    }

    static function GetFilteredMissions(\Illuminate\Http\Request $request)
    {
        $missionList = Mission::where('serverNumber', $request->query('server')); //->orderBy('gameType')->orderBy('max', 'desc')->get();
        $params = $request->query->all();
        $params = array_diff($params, ['Any']);
        $keys = array_keys($params);
        $values = array_values($params);
        $debug = '';
        for ($i = 0; $i < sizeof($keys); $i++) {
            if ($keys[$i] == 'server') $keys[$i] = 'serverNumber';
            $value = $values[$i];
            $key = $keys[$i];
            $debug .= '
            ' . $i . ': ' . $key . '-' . $value . ' :::';
            $fakeMissionList = $missionList;
            $fakeMissionList = $fakeMissionList->get();
            foreach ($fakeMissionList as $mis) {
                $debug .= $mis->id . ' ';
            }
            //Only if this is not a filter element
            if (strpos($key, '_filter') == false) {

                //check for special cases
                $special = false;

                if ($key == "lastPlayed") {
                    $special = true;

                    if ($values[$i - 1] == '<') {
                        $missionList = $missionList->Where(function ($missionList) use ($value) {
                            $missionList->where('lastPlayed', '<', $value)->orWhere('lastPlayed', null);
                        });
                    } else {
                        $missionList = $missionList->where($keys[$i], $values[$i - 1], $value);
                    }
                }
                if ($key == "rating") {
                    if ($values[$i - 1] == '<') $values[$i - 1] = '>';
                    else if ($values[$i - 1] == '>') $values[$i - 1] = '<'; //flip sign for account of swapped variables

                    $missionList = $missionList->whereRaw($value . ' ' . $values[$i - 1] . '(SELECT( (avg(briefing) + avg(equipment) + avg(enemy) + avg(location) + avg(reviews.objectives) + avg(enjoyment)) / 6)  FROM reviews where reviews.mission_id = missions.id ) ');
                    $special = true;
                }
                if ($key == "feedback") {
                    if ($values[$i - 1] == '<') $values[$i - 1] = '>';
                    else if ($values[$i - 1] == '>') $values[$i - 1] = '<'; //flip sign for account of swapped variables
                    $missionList = $missionList->whereRaw($value . ' ' . $values[$i - 1] . '(SELECT count(*) from reviews where reviews.mission_id = missions.id)');
                    $special = true;
                }
                if ($key == "author") {
                    $missionList = $missionList->where('user_id', $value);
                    $special = true;
                }
                if (!$special) {
                    if (isset($values[$i - 1]) && strpos($keys[$i - 1], '_filter') != false) {

                        $missionList = $missionList->where($key, $values[$i - 1], $value);
                    } else {
                        $missionList = $missionList->where($key, $value);
                    }
                }
            }
        }
        //dd($debug);
        return $missionList->get();

    }

}


