<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/

Route::namespace('Api')->group(function (){
    //Мэдээллийг 20 бичлэгээр хуудаслаж авна
    Route::get('news','ApiNewsController@news');
    //Өргөдөлийг 20 бичлэгээр хуудаслаж авна
    Route::get('urgudul','ApiUrgudulController@urgudul');
    //Зарыг 20 бичлэгээр хуудаслаж авна
    Route::get('zar','ApiZarController@zar');
    //Бүх зарын ангилалыг авна
    Route::get('zarCategory','ApiZarCategoryController@zarCategory');
    //Зарын ангилалаас зөвхөн нэг ангилалыг хүүхдүүдийн хамт
    Route::get('zarCategory/{id}','ApiZarCategoryController@getById');
    //Бүх санал асуулга хэлбэржүүлж авах
    Route::get('poll','ApiPollController@poll');
    //Зөвхөн нэг санал асуулгын ID өгсөн тохиолдолд санал асуулгыг асуулт, хариултын хамт илгээнэ
    Route::get('poll/{id}','ApiPollController@getById');
});

Route::middleware('auth:admin-api')->namespace('Admin')->prefix('admin')->group(function () {
    Route::get('user','AdminUserController@index');

    //ded site
    Route::resource('site','AdminSiteController');
    Route::post('site/{id}','AdminSiteController@update');
    Route::post('site_sidebar/{id}','AdminSiteController@site_sidebar');

    //admin user controller
    Route::post('admins/change_status','AdminAdminsController@change_status');
    Route::post('admins/{id}','AdminAdminsController@update');
    Route::resource('admins','AdminAdminsController');

    //news_category
    Route::post('news_category_save/{site_id}','AdminNewsCategoryController@save');
    Route::get('news_category/{site_id}','AdminNewsCategoryController@index');

    //file_category
    Route::post('file_category_save/{site_id}','AdminFileCategoryController@save');
    Route::get('file_category/{site_id}','AdminFileCategoryController@index');

    //zar_category
    Route::post('zar_category_save/{site_id}','AdminZarCategoryController@save');
    Route::get('zar_category/{site_id}','AdminZarCategoryController@index');
    Route::get('zar_category_select','AdminZarCategoryController@zar_category_select');

    //pages
    Route::post('pages','AdminPagesController@insert');
    Route::post('pages/{id}','AdminPagesController@update');
    Route::post('pages_delete','AdminPagesController@delete');
    Route::post('pages_change','AdminPagesController@change');
    Route::get('pages/{site_id}','AdminPagesController@index');
    Route::get('page_single/{id}','AdminPagesController@single');
    Route::get('pages_min/{site_id}/{id}','AdminPagesController@indexMin');

    //category link
    Route::resource('link_category','AdminLinkCategoryController');
    Route::get('link_category_show/{id}','AdminLinkCategoryController@index');
    Route::post('link_category/{id}','AdminLinkCategoryController@update');

    //link
    Route::resource('link','AdminLinkController');
    Route::get('link_show/{site_id}','AdminLinkController@index');
    Route::post('link/{id}','AdminLinkController@update');

    //file
    Route::resource('file','AdminFileController');
    Route::get('file_show/{site_id}','AdminFileController@index');
    Route::post('file/{id}','AdminFileController@update');


    //news
    Route::resource('news','AdminNewsController');
    Route::get('news_show/{site_id}','AdminNewsController@index');
    Route::post('news/{id}','AdminNewsController@update');
    Route::post('news_primary','AdminNewsController@change_primary');
    Route::post('news_status','AdminNewsController@change_status');


    //poll
    Route::resource('poll','AdminPollController');
    Route::get('poll_show/{site_id}','AdminPollController@index');
    Route::post('poll/{id}','AdminPollController@update');
    Route::post('poll_status','AdminPollController@change_status');

    //urgudul
    Route::resource('urgudul','AdminUrgudulController');
    Route::post('urgudul/{id}','AdminUrgudulController@update');

    //zar
    Route::resource('zar','AdminZarController');
    Route::post('zar/{id}','AdminZarController@update');

});

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::post('login','AdminLoginController@login');
    Route::post('logout_admin','AdminLoginController@logout');
});