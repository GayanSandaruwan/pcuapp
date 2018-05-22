<?php

namespace Tests\Unit;

use App\Http\Controllers\SearchController;
use App\Patient;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

//    public function createPatient(){
//
//        $patient = new Patient();
//        $patient->admission_no = "avasd";
//        $patient->name = "asda";
//
//        $patient->birthday = new \DateTime("18-01-1995");
//        $patient->gender = "male";
//        $patient->address = "Raddagoda";
//        $patient->area = "out";
//        $patient->nurse_id = 1;
//
//        $success = $patient->save();
//        $this->assertTrue(true);
//
//    }
//    public function testAge(){
////        $this->createPatient();
//        $patient = Patient::where("id",2)->first();
//        $age = $patient->age();
//        print("Age : ".$age->y);
//        $this->assertTrue(true);
//
//    }

//    public function testPatientAssessmentRel(){
//
//        $patient = Patient::where("id",1)->first();
//        $assessments = $patient->assessments()->get();
//
//        foreach ($assessments as $assessment){
//            printf("ID : ".$assessment->id);
//        }
//        $this->assertTrue(true);
//
//    }

//    public function testPatientSearch(){
//
//        $search = new SearchController();
//            $patients = $search->searchPatients("xxxxxx");
//            print $patients;
//        $this->assertTrue(true);
//
//    }

}
