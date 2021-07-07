<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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



Auth::routes(['verify'=>true]);

Route::group([
    'prefix'  => 'auth',
    'middleware' => 'auth',
    'namespace' => 'Auth',
], function() {
    Route::post('check_verify', 'VerificationController@check_verify');
    Route::get('resend_verification', 'VerificationController@resend_verification');
});
Route::group([
    'prefix'  => 'profile',
    'middleware' => 'auth',
], function() {
    Route::get('update', 'ProfileController@update');
    Route::get('favourite', 'ProfileController@favourite');
    Route::get('notifications', 'ProfileController@notifications');
    Route::post('post_update', 'ProfileController@post_update');
    Route::get('my_advertisements', 'ProfileController@my_advertisements');

});
Route::get('/', 'HomeController@index')->name('home');
Route::get('faq', 'HomeController@faq');
Route::get('privacy', 'HomeController@privacy');
Route::get('about', 'HomeController@about');
Route::get('terms', 'HomeController@terms');
Route::get('commission', 'HomeController@commission');
Route::get('contact_us', 'HomeController@contact_us');
Route::post('contact_us', 'HomeController@post_contact_us');
Route::get('app/lang', 'HomeController@lang');
Route::group([
    'prefix'  => 'advertisements',
], function() {
    Route::get('/', 'AdvertisementController@index');
    Route::get('response', 'AdvertisementController@response');
    Route::get('comment/response', 'AdvertisementController@comment_response');
    Route::get('show', 'AdvertisementController@show');
    Route::group([
        'middleware' => 'auth',
    ], function() {
        Route::post('response/toggle_fav', 'AdvertisementController@response_toggle_fav');
        Route::get('create', 'AdvertisementController@create');
        Route::get('edit', 'AdvertisementController@edit');
        Route::post('store', 'AdvertisementController@store');
        Route::post('update', 'AdvertisementController@update');
        Route::post('delete', 'AdvertisementController@delete');
        Route::post('comment', 'AdvertisementController@comment');
        Route::post('report_abuse', 'AdvertisementController@report_abuse');
        Route::post('comment/post_response', 'AdvertisementController@comment_post_response');
        Route::post('send_message', 'AdvertisementController@send_message');

    });
});
Route::group([
    'prefix'  => 'response',
], function() {
    Route::get('categories', 'ResponseController@categories');
    Route::post('delete/media', 'ResponseController@delete_media');
});

Route::group([
    'prefix'  => 'chat',
    'middleware' => 'auth',
], function() {
    Route::get('/', 'ChatController@index');
    Route::get('rooms', 'ChatController@chat_rooms');
    Route::get('messages', 'ChatController@chat_room_messages');
    Route::post('messages/send', 'ChatController@send_message');
});


Route::post('setNewPassword', 'Auth\ForgotPasswordController@setNewPassword')->name('setNewPassword');
Route::get('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
//Route::get('resetPassword/{id}','ResetPasswordController@resetPassword')->name('password.resetPassword');
