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
####---------FrontEnd Start--------######
Route::get('/','ServiceController@index');
Route::post('/service','ServiceController@get_service_subs');
Route::get('/service/{slug}','ServiceController@get_service');
Route::post('/make-order', 'ServiceController@makeOrder');
Route::get('/contact','ServiceController@contact');
Route::get('/about','ServiceController@about');
Route::get('/how-it-works','ServiceController@howItWorks');
Route::post('/send-message','ServiceController@send_msg');
Route::post('/request-call','ServiceController@req_call');
Route::get('/request-service','ServiceController@req_service');
Route::post('/make-service-request','ServiceController@add_req_service');
Route::get('/update_order_status/{id}', function($id) {

    DB::table('orders')->where(['id' => $id])->update([
        'order_status'=>'1'
    ]); 
    return redirect('/success');

});
Route::get('/success', function() {

    return 'Thanks!<br>Your order has been updated!';

});
####---------BackEnd Start--------######

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/setting', 'HomeController@setting');

//for messages
Route::get('/messages', 'HomeController@messages');
Route::get('/remove_message/{id}', 'HomeController@remove_message');
Route::post('/reply-msg', 'HomeController@replyMessage');

//for city
Route::get('/cities', 'HomeController@cities');
Route::post('/add_city', 'HomeController@add_city');
Route::get('/edit_city/{id}', 'HomeController@edit_city');
Route::post('/update_city', 'HomeController@update_city');
Route::get('/remove_city/{id}','HomeController@remove_city');


//for service
Route::get('/services', 'HomeController@services');
Route::get('/sub_services', 'HomeController@sub_services');
Route::post('/add_service', 'HomeController@add_service');
Route::post('/add_sub_service', 'HomeController@add_sub_service');
Route::get('/edit_service/{id}', 'HomeController@edit_service');
Route::get('/edit_sub_service/{id}', 'HomeController@edit_sub_service');
Route::post('/update_service', 'HomeController@update_service');
Route::get('/remove_service/{id}', 'HomeController@remove_service');
Route::post('/update_sub_service', 'HomeController@update_sub_service');
Route::get('/remove_sub_service/{id}', 'HomeController@remove_sub_service');

//for users
Route::get('/users', 'HomeController@users');


// for requests
Route::get('/requested-calls', 'HomeController@requested_calls');
Route::get('/remove_call_requests/{id}', 'HomeController@remove_requested_calls');
Route::get('/requested-services', 'HomeController@requested_services');
Route::get('/remove_service_requests/{id}', 'HomeController@remove_service_requests');



//app settings
Route::post('settings/update-profile', 'HomeController@update_profile');
Route::post('settings/about-us', 'HomeController@update_about_us');
Route::post('settings/social-links', 'HomeController@update_social_links');
Route::post('settings/contact-info', 'HomeController@update_contact_infos');


//for order
Route::get('/orders', 'HomeController@orders');
Route::post('/order/update', 'HomeController@update_order');
Route::get('/orders/pending', 'HomeController@pending_orders');
Route::get('/orders/completed', 'HomeController@completed_orders');
Route::get('/orders/cancelled', 'HomeController@cancelled_orders');
Route::get('/complete_order/{id}', 'HomeController@complete_order');
Route::get('/cancel_order/{id}', 'HomeController@cancel_order');
Route::get('/remove_order/{id}', 'HomeController@remove_order');

###-----------admin middleware------------####
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
	Route::match(['get', 'post'], '/adminOnlyPage/', 'HomeController@admin');
});

###-----------Super Admin middleware------------####
Route::group(['middleware' => 'App\Http\Middleware\SuperAdminMiddleware'], function()
{
	Route::post('/craete_user', 'HomeController@craete_user');
	Route::get('/edit_user/{id}', 'HomeController@edit');
	Route::post('/update_user', 'HomeController@update_user');
	Route::get('/remove_user/{id}', 'HomeController@remove_user');
	//maintanance
	Route::post('settings/maintanance', 'HomeController@update_maintanance');
});

Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});

// Authentication Routes...
// Route::get('login', [
//   'as' => 'login',
//   'uses' => 'Auth\LoginController@showLoginForm'
// ]);
// Route::post('login', [
//   'as' => '',
//   'uses' => 'Auth\LoginController@login'
// ]);
// Route::post('logout', [
//   'as' => 'logout',
//   'uses' => 'Auth\LoginController@logout'
// ]);

// Password Reset Routes...
// Route::post('password/email', [
//   'as' => 'password.email',
//   'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
// ]);
// Route::get('password/reset', [
//   'as' => 'password.request',
//   'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
// ]);
// Route::post('password/reset', [
//   'as' => 'password.update',
//   'uses' => 'Auth\ResetPasswordController@reset'
// ]);
// Route::get('password/reset/{token}', [
//   'as' => 'password.reset',
//   'uses' => 'Auth\ResetPasswordController@showResetForm'
// ]);

// Registration Routes...
// Route::get('register', [
//   'as' => 'register',
//   'uses' => 'Auth\RegisterController@showRegistrationForm'
// ]);
// Route::post('register', [
//   'as' => '',
//   'uses' => 'Auth\RegisterController@register'
// ]);