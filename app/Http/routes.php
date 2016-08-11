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

Route::group(['prefix' => 'documentos'], function(){
    Route::get('actas', 'documents@actas');
    Route::get('certificados', 'documents@certificados');
});

Route::group(['prefix' => 'import', 'middleware' => 'auth'], function(){
    Route::get('excel', 'Import@view');
    Route::post('upload', 'Import@upload');
    Route::get('unzip', 'Import@unzip');
    Route::get('upload/list', 'Import@list_files');
    Route::get('upload/process', 'Import@process');
    Route::get('upload/movePhotos', 'Import@movePhotos');
});

Route::group(['prefix' => 'manager', 'middleware' => 'auth'], function(){
    Route::get('lot/{id}', 'Manager@index');
    Route::post('save', 'Manager@processStudents');
    Route::post('process', 'Manager@processStudents');
});

Route::group(['prefix' => 'test'], function(){
    Route::get('expediente', 'test@expediente');
    Route::get('municipio', 'test@municipio');
});


Route::auth();

Route::get('/', ['middleware' => 'auth', 'uses' => 'HomeController@index']);
