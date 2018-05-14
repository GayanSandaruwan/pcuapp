<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');

Route::group(['middleware' => ['web', 'admin',]], function () {

    Route::get('/update/nurse/accounts',"AdminController@showNurseAccounts");
    Route::post('/update/nurse/accounts',"AdminController@alterNurseAccounts");



});
