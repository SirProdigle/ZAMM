<?php

namespace App;

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
        }
    }



    public function missions()
    {
        return $this->hasMany(Mission::class);
    }


}
