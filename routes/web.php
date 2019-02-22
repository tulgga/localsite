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

Route::get('/file_viewer/', 'Controller@file_viewer');

Route::get('/adminPanel/{vue_capture?}',function(){
    return view('admin');
})->where('vue_capture', '[\/\w\.-]*');

Route::get('/!/{vue_capture?}', 'Controller@index')->where('vue_capture', '[\/\w\.-]*');

Route::domain('volunteer.bayankhongor.local')->group(function () {
    Route::get('/', 'VolunteerController@index');
    Route::get('/c/{id}', 'VolunteerController@category');
    Route::get('/login', 'VolunteerController@login');
    Route::get('/register', 'VolunteerController@register');
    Route::post('/userRegister', 'VolunteerController@userRegister');
    Route::post('/organizationRegister', 'VolunteerController@organizationRegister');
});

Route::domain('zar.bayankhongor.local')->group(function () {
    Route::get('/', 'ZarController@index');
    Route::get('/c/{id}', 'ZarController@category');
});

Route::domain('{account}.bayankhongor.local')->group(function () {
    Route::get('/', 'SubController@index');
    Route::get('/p/{id}', 'SubController@page');
    Route::get('/news/{id}', 'SubController@news');
    Route::get('/category/{id}', 'SubController@category');
    Route::get('/files/{id}', 'SubController@files');
    Route::get('/feedback', 'SubController@feedback');
    Route::get('/archive', 'SubController@archive');
    Route::post('/urgudul_save', 'SubController@urgudul_save');
});

Route::get('/', 'Controller@homePage');
