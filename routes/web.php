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
    //左 に〜〜メソッドでアクセスしたら、右のcontrollerの@アクションに割り当てる
    Route::get ('news/create', 'Admin\NewsController@add')->middleware('auth');
    Route::post('news/create', 'Admin\NewsController@create')->middleware('auth');
    
    Route::get('news/edit', 'Admin\NewsController@edit')->middleware('auth'); 
    Route::post('news/edit', 'Admin\NewsController@update')->middleware('auth'); 
    
    Route::get('news/delete', 'Admin\NewsController@delete')->middleware('auth');
    
    Route::get('profile/create', 'Admin\Profilecontroller@add')->middleware('auth');
    Route:: post('profile/create', 'Admin\Profilecontroller@create')->middleware('auth');
    
    Route::get('profile/edit', 'Admin\Profilecontroller@edit')->middleware('auth');
    Route::post('profile/edit', 'Admin\Profilecontroller@update')->middleware('auth');
    
    Route::get('news', 'Admin\NewsController@index')->middleware('auth');
    
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
