<?php
use Illuminate\Support\Facades\Auth;
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

//Route::get('/!#/news/{id}', 'Controller@index');
Route::get('/!/{vue_capture?}', 'Controller@index')->where('vue_capture', '[\/\w\.-]*');


Route::domain('volunteer.'.env('DOMAIN_NAME', 'bayankhongor.gov.mn'))->group(function () {
    Route::get('/', 'VolunteerController@index');
    Route::get('/c/{id}', 'VolunteerController@category');
    Route::get('/login', 'VolunteerController@login');
    Route::get('/register', 'VolunteerController@register');
    Route::get('/userverify', 'VolunteerController@userverify');
    Route::post('/userRegister', 'VolunteerController@userRegister');
    Route::post('/loginUser', 'VolunteerController@loginUser');
    Route::get('/forgotpassword', 'VolunteerController@forgotpassword');
    Route::get('/logout', 'VolunteerController@logoutUser');
    Route::get('/profile', 'VolunteerController@profile');
    Route::post('/profileUpdate', 'VolunteerController@profileUpdate');
    Route::get('/organization', 'VolunteerController@organization');
    Route::get('/organizationform/{id}', 'VolunteerController@organizationform');
    Route::post('/organizationUpdate', 'VolunteerController@organizationUpdate');
    Route::get('/organizationUpdateStatus/{id}/{stat}', 'VolunteerController@organizationUpdateStatus');
    Route::get('/organizationdelete/{id}', 'VolunteerController@organizationdelete');
    Route::post('/socialsave', 'VolunteerController@socialsave');
    Route::get('/changePassword', 'VolunteerController@changePassword');
    Route::post('/updatePassword', 'VolunteerController@updatePassword');
    Route::get('/events', 'VolunteerController@events');
    Route::get('/eventlist', 'VolunteerController@eventlist');
    Route::get('/event/{id}', 'VolunteerController@event');
    Route::get('/eventform/{id}', 'VolunteerController@eventform');
    Route::post('/saveEvent', 'VolunteerController@saveEvent');
    Route::post('/searchPeople', 'VolunteerController@searchPeople');
    Route::post('/usrDeleteFromEvent', 'VolunteerController@usrDeleteFromEvent');
    Route::get('/eventdelete/{id}', 'VolunteerController@eventdelete');
    Route::get('/deleteImg/{img_id}/{event}', 'VolunteerController@deleteImg');
    Route::get('/eventUpdateStatus/{id}/{stat}', 'VolunteerController@eventUpdateStatus');
    /*** Ajax request response ***/
    Route::post('/event_like', 'VolunteerController@event_like');
    Route::post('/event_rate', 'VolunteerController@event_rate');
    /** Comment Send **/
    Route::post('/sendComment', 'VolunteerController@sendComment');
});

Route::domain('zar.'.env('DOMAIN_NAME', 'bayankhongor.gov.mn'))->group(function () {

    Route::get('/', 'ZarController@index');
    Route::get('/c/{id}.html', 'ZarController@category');
    Route::get('/p/{id}.html', 'ZarController@single');
    Route::get('/search.html', 'ZarController@search');
    Route::get('/post-ad.html', 'ZarController@add');
    Route::post('/postAdd', 'ZarController@postAdd');
});


Route::domain('dashboard.'.env('DOMAIN_NAME', 'bayankhongor.gov.mn'))->group(function () {
    Route::get('/', 'Dashboard@index');
    Route::get('/{site_id}/{role}', 'Dashboard@index');
    Route::get('/login', 'Dashboard@login');
    Route::get('/logout', 'Dashboard@logout');
    Route::post('/loginCheck', 'Dashboard@loginCheck');
    Route::get('/public/', 'Dashboard@public');
    Route::get('/public/{site_id}', 'Dashboard@public');
});


Route::domain('eservice.'.env('DOMAIN_NAME', 'bayankhongor.gov.mn'))->group(function () {
    Route::get('/', 'ServiceController@index');
    Route::get('/{id}', 'ServiceController@index');
    Route::get('/index/{id}', 'ServiceController@index');
});

Route::domain('{account}.'.env('SUB_DOMAIN'))->group(function () {
    Route::get('/', 'SubController@index');
    Route::get('/p/{id}', 'SubController@page');
    Route::get('/news/{id}', 'SubController@news');
    Route::get('/category/{id}', 'SubController@category');
    Route::get('/files/{id}', 'SubController@files');
    Route::get('/feedback', 'SubController@feedback');
    Route::get('/able', 'SubController@able');
    Route::get('/archive', 'SubController@archive');
    Route::post('/urgudul_save', 'SubController@urgudul_save');
    /*** Search ***/
    Route::get('search','SubController@search');
});

Route::get('/', 'Controller@homePage');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/saveAble', 'Controller@saveAble');
