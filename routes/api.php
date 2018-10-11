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



Route::middleware('auth:admin-api')->namespace('Admin')->prefix('admin')->group(function () {
    Route::get('user','AdminUserController@index');

    //ded site
    Route::resource('site','AdminSiteController');
    Route::post('site/{id}','AdminSiteController@update');

    //admin user controller
    Route::post('admins/change_status','AdminAdminsController@change_status');
    Route::post('admins/{id}','AdminAdminsController@update');
    Route::resource('admins','AdminAdminsController');

    //news_category
    Route::post('news_category','AdminNewsCategoryController@action');
    Route::post('news_category/delete','AdminNewsCategoryController@delete');
    Route::post('news_category/change','AdminNewsCategoryController@change');
    Route::get('news_category/{site_id}','AdminNewsCategoryController@index');

    //file_category
    Route::post('file_category','AdminFileCategoryController@action');
    Route::post('file_category/delete','AdminFileCategoryController@delete');
    Route::post('file_category/change','AdminFileCategoryController@change');
    Route::get('file_category/{site_id}','AdminFileCategoryController@index');

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

});

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::post('login','AdminLoginController@login');
    Route::post('logout_admin','AdminLoginController@logout');
});