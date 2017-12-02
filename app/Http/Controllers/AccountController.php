<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //


    public function  index(){
        $users = User::all();
        return view('accounts.index',compact('users'));
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

    public function DemoteUser(User $targetUser,User $activeUser,$role){
        if($activeUser->IsRoleOrAbove('Senior Admin')){
            if($activeUser->IsAboveRole($targetUser) && $activeUser->IsAboveRole($role)){
                $targetUser->role = $role;
                return "OK";
            }
            else{
                return "You need to be a higher role than the person you are demoting AND be demoting them to a level below you";
            }
        }
        else{
            return "You do not have the right prvilleges to change role";
        }
    }


}
