<?php

namespace App\Http\Controllers;

use App\Mission;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //


    public function index($id){
        $mission = Mission::find($id);
        return view('reviews.index',compact('mission'));
    }

    public function AddReview(Request $request){
        $review = new Review();
        $review->fill($request->all());
        $review->ip = $_SERVER['REMOTE_ADDR'];
        if(auth()->check()){
            $review->user_id = auth()->id();
        }
        $review->save();

        return redirect("/"); //TODO Add some flash messaging
    }


}
