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
    Route::get('/password/reset',"NurseAuth\ResetPasswordController@showResetForm");
    Route::post('/password/reset',"NurseAuth\ResetPasswordController@resetPassword");

    Route::get('/assessment/new/{patient_id}',"NurseController@showNewAssessmentForm");
    Route::post('/assessment/new',"NurseController@addAssessment");



});
