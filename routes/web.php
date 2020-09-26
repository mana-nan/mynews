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
    return view('welcome');
});

Route::group (['prefix' => 'admin'], function() {
    Route::get ('news/create', 'Admin\NewsController@add');
});

//PHP.Laravel０9課題−３
Route::get ('XXX', 'AAA@bbb');

//09課題−４
Route::group(['prefix' => 'admin'], function() {
    Route::get('profile/create', 'Admin\Profilecontroller@add');
    Route::get('profile/edit', 'Admin\Profilecontroller@edit');
});     
    


