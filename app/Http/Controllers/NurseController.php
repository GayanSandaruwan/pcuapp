<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $birthday = date('Y-m-d', strtotime($request->birthday));

        $patient->birthday = $birthday;
        $patient->gender = $request->gender;
        $patient->address = $request->address;
        $patient->area = $request->area;
        $patient->nurse_id = Auth::guard("nurse")->user()->id;

        $sucsee = $patient->save();
    }
}
