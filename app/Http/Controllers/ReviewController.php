<?php

namespace App\Http\Controllers;

use App\Mission;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //


    public function index($id){
        $mission = Mission::find($id);
        return view('reviews.index',compact('mission'));
    }


}
