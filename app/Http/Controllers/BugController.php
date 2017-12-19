<?php

namespace App\Http\Controllers;

use App\Bug;
use App\Mission;
use Illuminate\Http\Request;
use Monolog\Logger;
use Symfony\Component\Routing\Annotation\Route;

class BugController extends Controller
{

    public function index(Mission $mission){
        if($mission->user_id == auth()->id() || auth()->user()->isRoleOrAbove('Game Admin')){
            $disabled = false;
        }
        else{
            $disabled = true;
        }
        $bugs = $mission->bugs;

        return view('bugs.index',compact(['bugs','disabled','mission']));
    }

    public function ShowCreate(Mission $mission){
        return view('bugs.create',compact('mission'));
    }

    public function Create(Request $req){
        $bug = new Bug();
        $bug->fill($req->all());
        $bug->user_id = auth()->id();
        $bug->save();
        return redirect('/mission/' . $req->get('mission_id') .'/bugs');
    }

    public function Delete(Bug $bug){
            if (auth()->user()->isRoleOrAbove('Game Admin') || (auth()->user()->id == $bug->mission()->user()->id)) {
                $bug->delete();
                return "OK";
            } else {
                return "ERROR";
            }
    }


    //
}
