<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/missions','MissionController@Index')->middleware('updateMissions:' . request()->get('server'));

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('/user/{id}/missions','MissionController@userMissions')->middleware(['userMissions','updateMissions']);
Route::get('/mission/add',function(){return view('missions.add');});
Route::post('mission/add','MissionController@AddMission')->middleWare('auth');

Route::post('/mission/{id}','MissionController@Update')->middleware('auth');

Route::get('/mission/{id}', 'MissionController@UpdatePage')->middleware('auth');

Route::get('/review/{id}', 'ReviewController@index');

Route::post('/review','ReviewController@AddReview');

Route::get('/mission/{mission}/reviews', 'ReviewController@MissionReviews')->middleware('auth');

Route::get('/users','AccountController@index')->middleware(['auth','mustBeAdmin']);

Route::post('/users/{id}/delete','AccountController@RemoveUser')->middleware('auth');

Route::get('/mission/{mission}/delete','MissionController@Delete')->middleware(['auth','mustBeAdmin']);

Route::post('/users/{user}/role','AccountController@ChangeRole')->middleware('auth');
Route::get('/users/{user}/reviews','ReviewController@userReviews')->middleware('mustBeAdmin');

Route::get('/mission/{mission}/bugs','BugController@index')->middleware('auth');

Route::get('/bug/create/{mission}','BugController@ShowCreate');

Route::post('/bug/create','BugController@Create');

Route::post('/bug/delete/{bug}','BugController@Delete');

Route::get('/mission/{mission}/download','MissionController@Download');