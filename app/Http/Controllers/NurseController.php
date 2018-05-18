<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class NurseController extends Controller
{
    //

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'birthday' => 'required|date',
            'address' => 'required|min:10',
            'area' =>'required',
            'gender' => 'required',
            'admission_no' => 'required|unique:patients',
        ]);
    }

    public function addPatient(Request $request){
        $this->validator($request->all())->validate();

        $patient = new Patient();
        $patient->admission_no = $request->admission_no;
        $patient->name = $request->name;
        $birthday = date('Y-m-d', strtotime(str_replace('/', '-', $request->birthday)));

        $patient->birthday = $birthday;
        $patient->gender = $request->gender;
        $patient->address = $request->address;
        $patient->area = $request->area;
        $patient->nurse_id = Auth::guard("nurse")->user()->id;

        $success = $patient->save();
        if($success){
            return redirect("/nurse/assessment/new/".$patient->id);
        }
    }

    public function showNewAssessmentForm(Request $request,$patient_id){
        $patient = DB::table("patients")->where("id",$patient_id)->first();
        if($patient==null){
            return abort(404,"Invalid Patient");
        }
        return view('nurse.forms.newAssessment')->with(["patient"=>$patient]);
    }
    public function addAssessment(Request $request){

        $this->assessmentValidator($request->all())->validate();

        $assessment = new Assessment();
        $assessment->complain = $request->complain;
        $assessment->resp_rate = $request->resp_rate;
        $assessment->resp_effort = $request->resp_effort;
        $assessment->spo2 = $request->spo2;
        $assessment->o2_liters = $request->o2_liters;
        $assessment->heart_rate = $request->heart_rate;
        $assessment->systolic_bp = $request->systolic_bp;

        $assessment->nurse_id = Auth::guard('nurse')->user()->id;
        $assessment->patient_id = $request->patient_id;

        $success = $assessment->save();
        if($success){
            return redirect("/nurse/assessment/print/".$assessment->id);
        }
    }
    protected function assessmentValidator(array $data)
    {
        return Validator::make($data, [
            'resp_rate' => 'required|numeric|between:0,300',
            'resp_effort' => 'required|max:8',
            'spo2' => 'required|numeric|between:0,100',
            'o2_liters' =>'required|max:3',
            'heart_rate' => 'required|numeric|between:0,300',
            'systolic_bp' => 'required|numeric|between:0,300',
            'patient_id' => 'required|exists:patients,id'
        ]);
    }
}
