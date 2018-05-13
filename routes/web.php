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

});

/*
 * Only a logged in admin can create a nurse or another admin account
 */

Route::group(['middleware' => ['web', 'admin',]], function () {

    Route::get('admin/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('admin/register', 'AdminAuth\RegisterController@register');

    Route::get('nurse/register', 'NurseAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('nurse/register', 'NurseAuth\RegisterController@register');
    Route::get('admin/password/reset',"AdminAuth\ResetPasswordController@showResetForm");
    Route::post('admin/password/reset',"AdminAuth\ResetPasswordController@resetPassword");

});

Route::group(['prefix' => 'nurse'], function () {
    Route::get('/login', 'NurseAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'NurseAuth\LoginController@login');
    Route::post('/logout', 'NurseAuth\LoginController@logout')->name('logout');
});
