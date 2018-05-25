<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('nurse')->user();

    //dd($users);
    $assessmen_controller = new \App\Http\Controllers\AssessmentController();

    return view('nurse.home')->with(["critical_patients"=>$assessmen_controller->getCriticalAssessments()]);
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

    Route::get('/assessment/print/{assessment_id}',"AssessmentController@getAssessmentPrint");

    Route::get('/search',"SearchController@getSearchPage");

    Route::get('/search/{search}',"SearchController@searchPatients");

    Route::get('/patient/assessments/{admission_id}',"SearchController@getAssessments");

    Route::post('/search',"SearchController@searchPage");

    Route::get("/critical/patients","AssessmentController@getCriticalAssessments");

    Route::post("/patient/assessments/discharge/{assessment_id}","AssessmentController@dischargeAssessment");

    Route::get("patient/register/{start_date}/{end_date}","AssessmentController@getPatientRegister");
});
