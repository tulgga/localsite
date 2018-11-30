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

Route::get('/', 'Controller@homePage');

Route::get('/file_viewer/', 'Controller@file_viewer');



Route::get('/adminPanel/{vue_capture?}',function(){
    return view('admin');
})->where('vue_capture', '[\/\w\.-]*');

Route::get('/!/{vue_capture?}', 'Controller@index')->where('vue_capture', '[\/\w\.-]*');





Route::domain('{account}.bayankhongor.local')->group(function () {
    Route::get('/', 'SubDomainController@index');
});



