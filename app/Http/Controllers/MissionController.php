<?php

namespace App\Http\Controllers;

use App\Mission;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class MissionController extends Controller
{
    //
    public function index(Request $request)
    {
        $missionList = Mission::where('serverNumber', $request->query('server'))->get();
        if(auth()->user() != null){
           if(auth()->user()->isRoleOrAbove('Game Admin')){
               $disabled = false;
           }
           else
               $disabled = true;
        }
        else{
            $disabled = true;
        }

        $authorList = $this->GetAuthorList();



        return view('missions.index', compact(['missionList','disabled','authorList']));
    }

    public function userMissions($id)
    {
        $missionList = Mission::where('user_id', $id)->get();
        $disabled = false;
        $authorList = $this->GetAuthorList();
        return view('missions.index', compact(['missionList','disabled','authorList']));
    }


    //Accessed via update form and ajax requests from mission page, redirects to mission list of where the updated mission is from
    public function Update(Request $request,$id){
        Mission::find($id)->update($request->all());
        return redirect('/missions?server=' . Mission::find($id)->serverNumber);
    }


    public function UpdatePage($id){
        $mission = Mission::find($id);
        if(auth()->user()->isRoleOrAbove('Game Admin') || $mission->hasAuthorID(auth()->id())) {
            return view("missions.update", compact('mission'));
        }
        else dd('NO ACCESS');
    }



    private function GetAuthorList()
    {
        return  User::where(function ($query){
            return $query->where('role','Mission Dev')
                ->orWhere('role','Game Admin')
                ->orWhere('role','Senior Admin')->
                orWhere('role','Super Admin');
        })->get();
    }



}
