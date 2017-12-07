<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //


    public function  index(){
        $users = User::all();
        $roles= ["User","Mission Dev","Game Admin", "Senior Admin", "Super Admin"];
        $finalRoles =[];
        foreach($roles as $potRole){
            if(auth()->user()->IsAboveRole($potRole)){
                $finalRoles[] = $potRole;
            }
        }
        return view('accounts.index',compact(['users','finalRoles']));
    }

    //TODO test
    public function RemoveUser($userID){
        $user = User::find($userID);
        if(auth()->user()->IsRoleOrAbove('Senior Admin')){
            //Only Senior Admins + can remove accounts

            if($user->role =='Senior Admin' || $user->role == "Super Admin"){
                //DENY we cannot remove a senior admin or above through this method
                return "Cannot delete someone of this ranking";
            }
            else{
                if($user == auth()->user()){
                    //Cannot delete self
                    return "Error: Cannot Delete Self";
                }
                //We are a senior admin, they are not. This is fine
                $user->delete();
                return "OK";
            }
        }
        return;
    }

    public function ChangeRole(User $user){
        $role = \request()->role;
        $activeUser = auth()->user();
        if($activeUser->IsRoleOrAbove('Game Admin')){
            if($activeUser->IsAboveRole($user->role) && $activeUser->IsAboveRole($role)){
                $user->role = $role;
                $user->save();
                return "OK";
            }
            else{
                return "You need to be a higher role than the person you are changing AND be changing them to a level below you";
            }
        }
        else{
            return "You do not have the right privileges to change role";
        }
    }


}
