<?php

use Illuminate\Http\Request;
//use App\Http\Controllers\Auth;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/

Route::fallback(function(){
    return response()->json(['message' => 'Not Found!'], 404);
});

Route::middleware('auth:api')->namespace('Api')->group(function () {

    Route::get('myGroupAdmin', 'ApiGroupController@myGroupAdmin');
    Route::get('groupUsers/{group_id}', 'ApiGroupController@groupUsers');
    Route::get('myGroup', 'ApiGroupController@myGroup');
    Route::get('groups', 'ApiGroupController@group');
    Route::post('joinGroup', 'ApiGroupController@joinGroup');
    Route::post('joinAdminGroup', 'ApiGroupController@joinAdminGroup');
    Route::post('outAdminGroup', 'ApiGroupController@outAdminGroup');
    Route::post('outGroup', 'ApiGroupController@outGroup');
    Route::post('sendMessage', 'ApiGroupController@sendMessage');
    Route::get('messages/{group_id}', 'ApiGroupController@messages');

    Route::get('userInfo', 'ApiUserController@userInfo');


    Route::post('userInfoUpdate', 'ApiUserController@userInfoUpdate');
    Route::post('verify', 'ApiUserController@verify');

    Route::post('verifyPhone', 'ApiUserController@verifyPhone');
    Route::get('verifyEmail', 'ApiUserController@verifyEmail');
    Route::post('notificationUpdate', 'ApiUserController@notificationUpdate');


    Route::post('changeEmailRequest', 'ApiUserController@changeEmailRequest');
    Route::post('changeEmail', 'ApiUserController@changeEmail');


    Route::post('changePassword', 'ApiUserController@changePassword');

    Route::post('changePhoneRequest', 'ApiUserController@changePhoneRequest');
    Route::post('changePhone', 'ApiUserController@changePhone');

    Route::post('zarAdd','ApiZarController@zarAdd');

    Route::get('logOut', 'ApiUserController@logOut');

    //Volunteer
    Route::get('eventslistlogin','ApiVolunteerController@eventslistlogin');
    Route::post('event_like','ApiVolunteerController@event_like');
    Route::post('event_rate','ApiVolunteerController@event_rate');

});

Route::namespace('Api')->group(function (){

    Route::get('ildot','ApiPageController@ildot');
    Route::get('lavlagaa','ApiPageController@Lavlagaa');

    Route::get('service','ApiSiteController@service');
    //sites
    Route::get('sites','ApiSiteController@sites');
    Route::get('agentlag','ApiLinkController@agentlag');
    Route::get('homePoll','ApiPollController@homePoll');
    Route::post('sendPoll', 'ApiPollController@sendPoll');
    Route::post('sendUrgudul', 'ApiUrgudulController@sendUrgudul');

    Route::post('login', 'ApiUserController@login');
    Route::post('register', 'ApiUserController@register');
    Route::post('lostPassword', 'ApiUserController@lostPassword');
    Route::post('restorePassword', 'ApiUserController@restorePassword');

    Route::post('FacebookLogin', 'ApiUserController@FacebookLogin');

    Route::get('sidebar/{id}','ApiSiteController@sidebar');

    Route::get('sidebar1/{id}','ApiSiteController@sidebar1');
    Route::get('weather','ApiSiteController@weather');
    Route::get('menu/{id}/{is_main?}','ApiSiteController@page');
    Route::get('submenu/{id}','ApiSiteController@submenu');

    Route::get('site_news/{site_id}/{limit?}','ApiNewsController@site_news');
    Route::get('oronnutag/{limit?}','ApiNewsController@oronnutag');
    Route::get('VideoList/{site_id}/{limit?}','ApiNewsController@VideoList');

    Route::get('news_category/{site_id?}','ApiNewsController@news_category');
    Route::get('news/{site_id}/{id}','ApiNewsController@news');
    Route::get('newsListByCategoryBox/{site_id}/{limit}/{catId}','ApiNewsController@newsListByCategoryBox');
    Route::get('newsListByCategory/{site_id}/{catId}','ApiNewsController@newsListByCategory');
    Route::get('news_ontslokh/{id}','ApiNewsController@news_ontslokh');
    Route::get('categoryInfo/{id}','ApiNewsController@categoryInfo');

    Route::get('page/{site_id}/{id}', 'ApiPageController@single');
    Route::get('selected_menus/{id}', 'ApiPageController@selected_menus');


    Route::get('newsListPrimary/{limit?}','ApiNewsController@newsListPrimary');
    Route::get('newsListRecent/{limit?}','ApiNewsController@newsListRecent');
    Route::get('newsListOronnutag/{limit?}','ApiNewsController@newsListOronnutag');
    Route::get('newsListPhoto/{limit?}','ApiNewsController@newsListPhoto');
    Route::get('newsListVideo/{limit?}','ApiNewsController@newsListVideo');
    Route::get('searchNews','ApiNewsController@searchNews');
    Route::get('boxFileList/{cat_id}', 'ApiFileController@boxFileList');

    //Өргөдөлийг 40 бичлэгээр хуудаслаж авна
    Route::get('urgudul/{site_id}','ApiUrgudulController@urgudul');

    Route::get('heltes','ApiUrgudulController@heltes');
    Route::post('filterUrgudul','ApiUrgudulController@filterUrgudul');

    //Зарыг 20 бичлэгээр хуудаслаж авна
    Route::get('zar','ApiZarController@zar');
    //Бүх зарын ангилалыг авна
    Route::get('zarCategory','ApiZarCategoryController@zarCategory');
    //Зарыг 20 бичлэгээр хуудаслаж авна
    Route::get('zarByCategoryId/{id}','ApiZarController@zarByCategoryId');

    Route::get('zarSingle/{id}','ApiZarController@zarSingle');

    //Бүх санал асуулга хэлбэржүүлж авах
    Route::get('poll','ApiPollController@poll');
    //Зөвхөн нэг санал асуулгын ID өгсөн тохиолдолд санал асуулгыг асуулт, хариултын хамт илгээнэ
    Route::get('poll/{id}','ApiPollController@getById');

    //Сайн дурыхан
    Route::get('eventslist','ApiVolunteerController@eventslist');
    Route::get('event/{id}/{user_id?}','ApiVolunteerController@event');
    
    Route::get('dash_events/{id}','ApiEventController@index');
    Route::get('dash_events/going/{id}/{user_id}/{ip}/{device}','ApiEventController@going');
});

Route::middleware('auth:admin-api')->namespace('Admin')->prefix('admin')->group(function () {

    Route::get('user','AdminLoginController@index');

    //heltes
    Route::resource('heltes','AdminHeltesController');
    Route::post('heltes/{id}','AdminHeltesController@update');

    //group
    Route::resource('group','AdminGroupController');
    Route::post('group/change_status','AdminGroupController@change_status');
    Route::get('group/user_change_yes/{id}','AdminGroupController@user_change_yes');
    Route::get('group/user_change_no/{id}','AdminGroupController@user_change_no');
    Route::get('group/users/{id}','AdminGroupController@users');
    Route::post('group/{id}','AdminGroupController@update');

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

    //lavlagaa
    Route::post('lavlagaa','AdminLavlagaaController@insert');
    Route::post('lavlagaa/{id}','AdminLavlagaaController@update');
    Route::post('lavlagaa_delete','AdminLavlagaaController@delete');
    Route::post('lavlagaa_change','AdminLavlagaaController@change');
    Route::get('lavlagaa','AdminLavlagaaController@index');
    Route::get('lavlagaa_single/{id}','AdminLavlagaaController@single');

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
    Route::get('file_show/{site_id}/{cat_id?}','AdminFileController@index1');
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
    Route::get('webNotification/{site_id}/{heltes_id}','AdminUrgudulController@webNotification');
    Route::get('urgudul_show/{site_id}','AdminUrgudulController@index1');
    Route::post('urgudul/{id}','AdminUrgudulController@update');

    //zar
    Route::resource('zar','AdminZarController');
    Route::post('zar/{id}','AdminZarController@update');

    Route::get('zarBanner','AdminZarBannerController@index');
    Route::post('zarBanner','AdminZarBannerController@save');

    //dashboard
    Route::resource('dashboard_police','AdminDashboardPoliceController');
    Route::post('dashboard_police/{id}','AdminDashboardPoliceController@update');

    //hospital
    Route::resource('dashboard_hospital','AdminDashboardHospitalController');
    Route::post('dashboard_hospital/{id}','AdminDashboardHospitalController@update');

    //nema
    Route::resource('dashboard_nema','AdminDashboardNemaController');
    Route::post('dashboard_nema/{id}','AdminDashboardNemaController@update');


    //nema
    Route::resource('dashboard_budget','AdminDashboardBudgetController');
    Route::post('dashboard_budget/{id}','AdminDashboardBudgetController@update');


    //news
    Route::resource('dashboard_news','AdminDashboardNewsController');
    Route::post('dashboard_news/{id}','AdminDashboardNewsController@update');

    //news
    Route::resource('dashboard_schedule','AdminDashboardScheduleController');
    Route::post('dashboard_schedule/{id}','AdminDashboardScheduleController@update');

    //user
    Route::resource('users','AdminUserController');
    Route::get('AllUsers','AdminUserController@AllUsers');
    Route::post('users/{id}','AdminUserController@update');

});

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::post('login','AdminLoginController@login');
    Route::post('logout_admin','AdminLoginController@logout');
});
