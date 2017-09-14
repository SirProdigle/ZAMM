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

Route::get('/missions','MissionController@Index')->middleware('updateMissions');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('/user/{id}/missions','MissionController@userMissions')->middleware(['userMissions','updateMissions']);

Route::post('/mission/{id}','MissionController@Update')->middleware('auth');

Route::get('/mission/{id}', 'MissionController@UpdatePage')->middleware('auth');