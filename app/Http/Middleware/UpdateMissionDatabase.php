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
     * @return mixed
     */


    public function handle($request, Closure $next)
    {
        $missionList = $this->GrabMissions();
        $missionList = $this->CheckForUpdatedMissions($missionList);
        $this->InsertNewMissions($missionList);


        return $next($request);
    }


    public function CheckForUpdatedMissions($missionList)
    {
        $Server0MissionsFile = [];
        $Server1MissionsFile = [];

        foreach ($missionList as $potentialMission) {
            if ($potentialMission->server == 0) {
                $Server0MissionsFile[] = $potentialMission;
            }
        }
        foreach ($missionList as $potentialMission) {
            if ($potentialMission->server == 1) {
                $Server1MissionsFile[] = $potentialMission;
            }
        }

        $Server0MissionsDatabase = Mission::where('serverNumber', 0)->get();

        $indicesToRemove = [];
        foreach ($Server0MissionsDatabase as $dbMission) {

            foreach ($Server0MissionsFile as $fileMission) {
                if (explode(' v', $dbMission->fileName)[0] == explode(' v', $fileMission->fileName)[0]) {
                    if ($dbMission->version < $fileMission->version) {
                        //Needs to be updated;
                        //dd("Db: " . $dbMission->fileName . " " . $dbMission->version . "\nFile: " . $fileMission->fileName . " " . $fileMission->version);
                        $dbMission->version = $fileMission->version;
                        $dbMission->save();
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

        $Server1MissionsDatabase = Mission::where('serverNumber', 1)->get();

        $indicesToRemove = [];
        foreach ($Server1MissionsDatabase as $dbMission) {

            foreach ($Server1MissionsFile as $fileMission) {

                if (explode(' v', $dbMission->fileName)[0] == explode(' v', $fileMission->fileName)[0]) {
                    if ($dbMission->version < $fileMission->version) {
                        //Needs to be updated;

                        //dd("Db: " . $dbMission->fileName . " " . $dbMission->version . "\nFile: " . $fileMission->fileName . " " . $fileMission->version);

                        $dbMission->version = $fileMission->version;
                        $dbMission->save();

                    }
                    //We need to remove this copy from our listing
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
            $newMission->max = $mission->maxPlayers;
            $newMission->island = $mission->island;
            $newMission->displayName = $mission->displayName;

            $missionData = [];
            $missionData['fileName'] = $mission->fileName;
            $missionData['serverNumber'] = $mission->server;
            $missionData['version'] = $mission->version;
            $missionData['gameType'] = $mission->gameType;
            $missionData['max'] = $mission->maxPlayers;
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


    public function GrabMissions()
    {
        $missionsToReturn = [];

        $directories = config('mission.directories');
        for ($i = 0; $i < count($directories); $i++) {
            $files = scandir($directories[$i]);
            foreach ($files as $filename) {
                if (substr($filename, -4) == ".pbo") {
                    $readMission = new MissionData($filename, $i);
                    $missionsToReturn[] = $readMission;
                }
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
    public $maxPlayers;
    public $island;
    public $displayName;

    public function __construct($fileName, $server)
    {
        $this->fileName = $fileName;
        $this->server = $server;
        try {
            $this->version = substr(explode(' v', $this->fileName)[1], 0, 2);
            $this->version = preg_replace("/[^0-9]/", "", $this->version);
            if (strpos($this->version, '')) {
                $this->version = 1;
            }
        } catch (\ErrorException $e) {
            $this->version = 1;
        }
        if (isset(explode(' ', $this->fileName)[0])) {
            $this->gameType = explode(' ', $this->fileName)[0];
        }
        if (isset(explode(' ', $this->fileName)[1])) {
            $this->maxPlayers = explode(' ', $this->fileName)[1];
            if ($this->maxPlayers == '' || !is_numeric($this->maxPlayers)) {
                $this->maxPlayers = -1; //If max players not parsed correctly this is our error code
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
