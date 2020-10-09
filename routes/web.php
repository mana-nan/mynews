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

Route::group (['prefix' => 'admin', 'middleware' => 'auth'], function() {
    //左 に〜〜メソッドでアクセスしたら、右のcontrollerの@アクションに割り当てる
    Route::get ('news/create', 'Admin\NewsController@add');
    Route::post('news/create', 'Admin\NewsController@create');
    
    Route::get('news/edit', 'Admin\NewsController@edit');
    Route::post('news/edit', 'Admin\NewsController@update');
    
    Route::get('news/delete', 'Admin\NewsController@delete');
    
    Route::get('profile/create', 'Admin\Profilecontroller@add');
    Route:: post('profile/create', 'Admin\Profilecontroller@create');
    
    Route::get('profile/edit', 'Admin\Profilecontroller@edit');
    Route::post('profile/edit', 'Admin\Profilecontroller@update');
    
    Route::get('news', 'Admin\NewsController@index');
    Route::get('profile', 'Admin\Profilecontroller@index');
    
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/news', 'NewsController@index');
Route::get('/profile', 'Profilecontroller@index');