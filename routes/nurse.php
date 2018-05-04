<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('nurse')->user();

    //dd($users);

    return view('nurse.home');
})->name('home');

Route::group(['middleware' => ['web', 'nurse',]], function () {
    Route::get('/patient/add/',function(){
        return view('nurse.forms.patient');
    });
    Route::post('/patient/add/',"NurseController@addPatient");

});
