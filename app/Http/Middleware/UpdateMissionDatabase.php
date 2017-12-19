<?php

namespace App\Http\Middleware;

use App\Mission;
use App\MissionRequest;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Mockery\Exception;
use Psy\Exception\ErrorException;

class UpdateMissionDatabase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param int $serverNum
     * @return mixed
     */


    public function handle($request, Closure $next, $serverNum)
    {
        $missionList = $this->GrabMissions($serverNum);
        $missionList = $this->CheckForUpdatedMissions($missionList, $serverNum);
        $this->InsertNewMissions($missionList);


        return $next($request);
    }


    public function CheckForUpdatedMissions($missionList, $serverNum)
    {
        $ServerMissionsFile =[];

        foreach ($missionList as $potentialMission) {
                $ServerMissionsFile[] = $potentialMission;
        }


        $ServerMissionsDatabase = Mission::where('serverNumber', $serverNum)->get();

        $indicesToRemove = [];
        foreach ($ServerMissionsDatabase as $dbMission) {

            foreach ($ServerMissionsFile as $fileMission) {
                if (explode(' v', $dbMission->fileName)[0] == explode(' v', $fileMission->fileName)[0]) {
                    if ($dbMission->version < $fileMission->version && $dbMission->island == $fileMission->island) {
                        //Needs to be updated;
                        //dd("Db: " . $dbMission->fileName . " " . $dbMission->version . "\nFile: " . $fileMission->fileName . " " . $fileMission->version);
                        $dbMission->version = $fileMission->version;
                        $dbMission->fileName = $fileMission->fileName;
                        $tempDName = explode(' ', $dbMission->fileName);
                        unset($tempDName[1]);
                        unset($tempDName[0]);
                        $dbMission->displayName = implode(' ', $tempDName);
                        $dbMission->status = 'Updated';
                        if(Mission::where('fileName',$fileMission->fileName)->count() > 0){
                            // We have 2 missions stored of different version
                            \Log::error('Mission: ' . $dbMission->fileName . ' has multiple version stored in the folder. We cannot process a version update');
                        }
                        else {
                            $dbMission->save();
                        }

                    }
                    //Remove from list to insert
                    for ($x = 0; $x < count($missionList); $x++) {
                        if ($missionList[$x]->fileName == $fileMission->fileName) {
                            $indicesToRemove[] = $x;
                            //unset($missionList[$x]);
                            //$missionList = array_values($missionList);
                            break;
                        }
                    }
                }
            }
        }
        $missionList = array_diff_key($missionList, array_flip($indicesToRemove));
        $missionList = array_values($missionList);
        return $missionList;
    }


    public function InsertNewMissions($missionList)
    {
        $missionsToInsert = [];
        \DB::disableQueryLog();
        foreach ($missionList as $mission) {
            $newMission = new Mission();
            $newMission->fileName = $mission->fileName;
            $newMission->serverNumber = $mission->server;
            $newMission->version = $mission->version;
            $newMission->gameType = $mission->gameType;
            $newMission->max = $mission->max;
            $newMission->island = $mission->island;
            $newMission->displayName = $mission->displayName;

            $missionData = [];
            $missionData['fileName'] = $mission->fileName;
            $missionData['serverNumber'] = $mission->server;
            $missionData['version'] = $mission->version;
            $missionData['gameType'] = $mission->gameType;
            $missionData['max'] = $mission->max;
            $missionData['island'] = $mission->island;
            $missionData['displayName'] = $mission->displayName;
            try {
                $mRequest = MissionRequest::where('fileName', $missionData['fileName'])->firstOrFail();
                $missionData['user_id'] = $mRequest->user->id;
                $mRequest->delete();
            } catch (ModelNotFoundException $e) {
                //No worries so just leave it
            }
            $missionsToInsert[] = $missionData;
        }
        Mission::insert($missionsToInsert); //FIXME This only works if the entire array is correctly formatted. Add one after the other for now
        \DB::enableQueryLog();
    }


    public function GrabMissions($num)
    {
        $missionsToReturn = [];

        $directories = config('mission.directories');
            $files = scandir($directories[$num]);
            foreach ($files as $filename) {
                if (substr($filename, -4) == ".pbo") {
                    $readMission = new MissionData($filename, $num);
                    $missionsToReturn[] = $readMission;
                }
            }
        return $missionsToReturn;
    }
}


class MissionData
{
    public $fileName;
    public $server;
    public $version;
    public $gameType;
    public $max;
    public $island;
    public $displayName;

    public function __construct($fileName, $server)
    {
        $this->fileName = $fileName;
        $this->server = $server;
        try {
            $this->version = substr(explode(' v', strtolower( $this->fileName))[1], 0, 2);
            $this->version = preg_replace("/[^0-9]/", "", $this->version);
            $this->version = (int)$this->version;
            if (strpos($this->version, '')) {
            }
        } catch (\ErrorException $e) {
            //$this->version = 1;
            //die($e);
        }
        if (isset(explode(' ', $this->fileName)[0])) {
            $this->gameType = explode(' ', $this->fileName)[0];
        }
        if (isset(explode(' ', $this->fileName)[1])) {
            $this->max = explode(' ', $this->fileName)[1];
            if ($this->max == '' || !is_numeric($this->max)) {
                $this->max = -1; //If max players not parsed correctly this is our error code
            }
        }
        if (isset(explode('.', $this->fileName)[1])) {
            $this->island = explode('.', $this->fileName)[1];
        }

        $this->displayName = explode(' ', $this->fileName);
        unset($this->displayName[1]);
        unset($this->displayName[0]);
        $this->displayName = implode(' ', $this->displayName);
    }

    private function GetNonVersionName()
    {
        return explode(' v', $this->fileName)[0];
    }
}
