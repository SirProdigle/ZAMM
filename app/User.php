<?php

namespace App;

use function GuzzleHttp\default_ca_bundle;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function IsRoleOrAbove($role)
    {
        switch ($role) {
            case 'Super Admin':
                return auth()->user()->role == "Super Admin";
                break;
            case 'Senior Admin':
                return auth()->user()->role == "Super Admin" ||
                    auth()->user()->role == "Senior Admin";
                break;
            case 'Game Admin':
                return auth()->user()->role == "Super Admin" ||
                    auth()->user()->role == "Senior Admin" ||
                    auth()->user()->role == "Game Admin";
                break;
            case 'Mission Dev':
                return auth()->user()->role != "User";
                break;
            case 'User':
                return auth()->check();
                break;
            default:
                return false;
        }
    }



    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function missionRequests(){
        return $this->hasMany(MissionRequest::class);
    }


}
