<?php

namespace App\Http\Controllers;

use App\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;


class SearchController extends Controller
{
    //

    public function searchPatients(Request $request,$search){

        $patients_by_name = DB::table('patients')
            ->join('admissions','patients.id','=','admissions.patient_id')
            ->select('patients.*','admissions.admission_no','admissions.id as admission_id')
            ->where(DB::raw('LOWER(name)'),'LIKE','%'.strtolower($search).'%');
//            ->orderByRaw("(CASE
//                        WHEN LOWER(name) LIKE '".$search."%' THEN 1
//                        WHEN LOWER(name) LIKE '%".$search."' THEN 3
//                        ELSE 2
//                      END)");
        $patients_by_admission_no = DB::table('patients')
            ->join('admissions','patients.id','=','admissions.patient_id')
            ->select('patients.*','admissions.admission_no','admissions.id as admission_id')
            ->where(DB::raw('LOWER(admission_no)'),'LIKE','%'.strtolower($search).'%');
//            ->orderByRaw("(CASE
//                        WHEN LOWER(admission_no) LIKE '".$search."%' THEN 1
//                        WHEN LOWER(admission_no) LIKE '%".$search."' THEN 3
//                        ELSE 2
//                      END)");

        $patients = $patients_by_admission_no->union($patients_by_name)
                                                ->get();
//        echo $patients;
        return view('nurse.forms.searchResults')->with(["patients"=>$patients]);
    }

    public function getSearchPage(Request $request){

        return view('nurse.forms.searchPatients');
    }

    public function searchPage(Request $request){

        $this->validator($request->all())->validate();

        $search = $request->search;

        return redirect("nurse/search/".$search);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'search' => 'required|max:255',
        ]);
    }

    public function getAssessments(Request $request,$admission_id){

       $admission =  Admission::where('id',$admission_id)->first();
       if($admission== null){
           return abort(404);
       }

       $assessments = $admission->assessments()->orderBy('created_at', 'desc')->get();
       if($assessments == null){
           return abort(404);
       }
       $patient = $admission->patient()->first();
//       echo $patient;
       return view('nurse.forms.assessmentsList')->with(["assessments"=>$assessments,"patient"=>$patient]);
//        echo $assessments;
    }

}
