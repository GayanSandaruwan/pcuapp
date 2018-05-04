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

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'AdminAuth\LoginController@login');
    Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');


//    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

});

/*
 * Only a logged in admin can create a nurse or another admin account
 */

Route::group(['middleware' => ['web', 'admin',]], function () {

    Route::get('admin/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('admin/register', 'AdminAuth\RegisterController@register');

    Route::get('nurse/register', 'NurseAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('nurse/register', 'NurseAuth\RegisterController@register');
});

Route::group(['prefix' => 'nurse'], function () {
    Route::get('/login', 'NurseAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'NurseAuth\LoginController@login');
    Route::post('/logout', 'NurseAuth\LoginController@logout')->name('logout');


//  Route::post('/password/email', 'NurseAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'NurseAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'NurseAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'NurseAuth\ResetPasswordController@showResetForm');
});
