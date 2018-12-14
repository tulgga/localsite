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
    //menu

    Route::get('sidebar/{id}','ApiSiteController@sidebar');
    Route::get('weather','ApiSiteController@weather');
    Route::get('menu/{id}','ApiSiteController@page');
    Route::get('submenu/{id}','ApiSiteController@submenu');

    Route::get('site_news/{site_id}/{limit?}','ApiNewsController@site_news');
    Route::get('oronnutag/{limit?}','ApiNewsController@oronnutag');
    Route::get('VideoList/{site_id}/{limit?}','ApiNewsController@VideoList');
    Route::get('news_category/{site_id?}','ApiNewsController@news_category');
    Route::get('news/{site_id}/{id}','ApiNewsController@news');
    Route::get('newsListByCategoryBox/{site_id}/{limit}/{catId}','ApiNewsController@newsListByCategoryBox');
    Route::get('newsListByCategory/{site_id}/{catId}','ApiNewsController@newsListByCategory');
    Route::get('news_ontslokh/{id}','ApiNewsController@news_ontslokh');

    Route::get('page/{site_id}/{id}', 'ApiPageController@single');

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
    Route::post('site_menu/{id}','AdminSiteController@site_menu');
    Route::post('site_config/{id}','AdminSiteController@site_config');
    Route::get('get_config/{id}','AdminSiteController@get_config');
    Route::get('get_menu/{id}','AdminSiteController@get_menu');

    //admin user controller
    Route::post('admins/change_status','AdminAdminsController@change_status');
    Route::post('admins/{id}','AdminAdminsController@update');
    Route::resource('admins','AdminAdminsController');

    //news_category
    Route::post('news_category_save/{site_id}','AdminNewsCategoryController@save');
    Route::get('news_category/{site_id}','AdminNewsCategoryController@index1');

    //menu
    Route::post('menu_save/{site_id}','AdminMenuController@save');
    Route::get('menu/{site_id}','AdminMenuController@index1');

    //file_category
    Route::post('file_category_save/{site_id}','AdminFileCategoryController@save');
    Route::get('file_category/{site_id}','AdminFileCategoryController@index1');

    //zar_category
    Route::post('zar_category_save/{site_id}','AdminZarCategoryController@save');
    Route::get('zar_category/{site_id}','AdminZarCategoryController@index1');
    Route::get('zar_category_select','AdminZarCategoryController@zar_category_select');

    //pages
    Route::post('pages','AdminPagesController@insert');
    Route::post('pages/{id}','AdminPagesController@update');
    Route::post('pages_delete','AdminPagesController@delete');
    Route::post('pages_change','AdminPagesController@change');
    Route::get('pages/{site_id}/{is_main?}','AdminPagesController@index1');
    Route::get('page_select/{site_id}/{id?}','AdminPagesController@page_select');
    Route::get('page_single/{id}','AdminPagesController@single');
    Route::get('pages_min/{site_id}/{id}','AdminPagesController@indexMin');

    //category link
    Route::resource('link_category','AdminLinkCategoryController');
    Route::get('link_category_show/{id}','AdminLinkCategoryController@index1');
    Route::post('link_category/{id}','AdminLinkCategoryController@update');

    //link
    Route::resource('link','AdminLinkController');
    Route::get('link_show/{site_id}','AdminLinkController@index1');
    Route::post('link/{id}','AdminLinkController@update');

    //file
    Route::resource('file','AdminFileController');
    Route::get('file_show/{site_id}','AdminFileController@index1');
    Route::get('file_select/{site_id}','AdminFileController@file_select');
    Route::post('file/{id}','AdminFileController@update');


    //news
    Route::resource('news','AdminNewsController');
    Route::get('news_show/{site_id}/{cat_id?}','AdminNewsController@index1');
    Route::get('news_select/{site_id}','AdminNewsController@news_select');

    Route::get('sub_news_publish','AdminNewsController@sub_news_publish');

    Route::post('news/{id}','AdminNewsController@update');
    Route::post('news_primary','AdminNewsController@change_primary');
    Route::post('news_status','AdminNewsController@change_status');
    Route::post('main_site_publish','AdminNewsController@main_site_publish');



    //poll
    Route::resource('poll','AdminPollController');
    Route::get('poll_show/{site_id}','AdminPollController@index1');
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