<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'import'], function(){
    Route::get('excel', 'Import@view');
    Route::get('upload/file', 'Import@upload');
    Route::get('upload/list', 'Import@list_files');
    Route::get('upload/process', 'Import@process');
});

Route::auth();

Route::get('/home', 'HomeController@index');
