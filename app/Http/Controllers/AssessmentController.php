<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\Patient;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    //
    public function calculateScore($assessment_id){

        $assessment = Assessment::where("id",$assessment_id)->first();
        if($assessment->count()){
            $patient = $assessment->patient()->first();
//            var_dump($patient);
            if($patient->count()){
                $age = $patient->age();
                $heart_rate_score = $this->heartRateScore($assessment,$age);
                $systolic_bp_score = $this->systolicBPScore($assessment,$age);
                $resp_rate_score = $this->respRateScore($assessment,$age);
                $o2_sat_score = $this->o2SatScore($assessment);
                $o2_flow_rate_score =$this->o2FlowRateScore($assessment);
                $resp_effort_score = $this->respEffort($assessment);

                $total_score = $heart_rate_score+$systolic_bp_score+$resp_rate_score+$o2_sat_score+$o2_flow_rate_score+$resp_effort_score;

                echo "O2 Flow rate  : ".$o2_flow_rate_score." Heart Rate Score : ".$heart_rate_score." Systolic Bp : ".$systolic_bp_score." Resp Rate  : ".$resp_rate_score." O2 Sat Score : ".$o2_sat_score. " Resp Effort : ".$resp_effort_score." Total Score : ".$total_score;
            }
            else{
                return abort(404,"Invalid Patient");

            }

        }
        else{
            return abort(404,"Invalid Patient");
        }

    }

    private function heartRateScore(Assessment $assessment,$age){
        $heart_rate = $assessment->heart_rate;
        $score = 0;
        if($age->y >= 12){
            switch ($heart_rate){
                case $heart_rate>=140:
                    $score = 3;
                    break;
                case $heart_rate>=120:
                    $score = 2;
                    break;
                case $heart_rate >=100:
                    $score = 1;
                    break;
                case $heart_rate>=60:
                    $score = 0;
                    break;
                case $heart_rate >=40:
                    $score = 1;
                    break;
                case $heart_rate <=40:
                    $score = 3;
                    break;
            }
            return $score;

        }
        elseif ($age->y >=5){
            switch ($heart_rate){
                case $heart_rate>=150:
                    $score = 3;
                    break;
                case $heart_rate>=130:
                    $score = 2;
                    break;
                case $heart_rate >=110:
                    $score = 1;
                    break;
                case $heart_rate>=170:
                    $score = 0;
                    break;
                case $heart_rate >=50:
                    $score = 1;
                    break;
//                case $heart_rate >=0:
//                    $score = 2;
//                    break;
                case $heart_rate <50:
                    $score = 3;
                    break;

            }
            return $score;

        }

        elseif ($age->y >=1){
            switch ($heart_rate){
                case $heart_rate>=170:
                    $score = 3;
                    break;
                case $heart_rate>=150:
                    $score = 2;
                    break;
                case $heart_rate >=130:
                    $score = 1;
                    break;
                case $heart_rate>=80:
                    $score = 0;
                    break;
                case $heart_rate >=60:
                    $score = 1;
                    break;
//                case $heart_rate >=0:
//                    $score = 2;
//                    break;
                case $heart_rate <60:
                    $score = 3;
                    break;

            }
            return $score;

        }
        elseif ($age->m >=4){
            switch ($heart_rate){
                case $heart_rate>=180:
                    $score = 3;
                    break;
                case $heart_rate>=170:
                    $score = 2;
                    break;
                case $heart_rate >=150:
                    $score = 1;
                    break;
                case $heart_rate>=100:
                    $score = 0;
                    break;
                case $heart_rate >=70:
                    $score = 1;
                    break;
//                case $heart_rate >=0:
//                    $score = 2;
//                    break;
                case $heart_rate <70:
                    $score = 3;
                    break;

            }
            return $score;

        }
        else{
            switch ($heart_rate){
                case $heart_rate>=190:
                    $score = 3;
                    break;
                case $heart_rate>=180:
                    $score = 2;
                    break;
                case $heart_rate >=150:
                    $score = 1;
                    break;
                case $heart_rate>=110:
                    $score = 0;
                    break;
                case $heart_rate >=90:
                    $score = 1;
                    break;
                case $heart_rate >=80:
                    $score = 2;
                    break;
                case $heart_rate <80:
                    $score = 3;
                    break;
            }
            return $score;

        }
    }
    private function systolicBPScore(Assessment $assessment, $age){
        $systolic_bp = $assessment->systolic_bp;
        $score = 0;

        if($age->y >= 12){
            switch ($systolic_bp){
                case $systolic_bp >=150:
                    $score = 3;
                    break;
                case $systolic_bp >=130:
                    $score = 2;
                    break;
                case $systolic_bp >=120:
                    $score = 1;
                    break;
                case $systolic_bp >=110:
                    $score = 0;
                    break;
                case $systolic_bp >=90:
                    $score = 1;
                    break;
                case $systolic_bp <90:
                    $score = 3;
                    break;
            }
        }
        elseif ($age->y >=5){
            switch ($systolic_bp){
                case $systolic_bp >=140:
                    $score = 3;
                    break;
                case $systolic_bp >=130:
                    $score = 2;
                    break;
                case $systolic_bp >=120:
                    $score = 1;
                    break;
                case $systolic_bp >=90:
                    $score = 0;
                    break;
                case $systolic_bp >=80:
                    $score = 1;
                    break;
                case $systolic_bp <80:
                    $score = 3;
                    break;
            }
        }
        elseif ($age->y>=4){
            switch ($systolic_bp){
                case $systolic_bp >=130:
                    $score = 3;
                    break;
                case $systolic_bp >=120:
                    $score = 2;
                    break;
                case $systolic_bp >=110:
                    $score = 1;
                    break;
                case $systolic_bp >=90:
                    $score = 0;
                    break;
                case $systolic_bp >=80:
                    $score = 1;
                    break;
                case $systolic_bp >=70:
                    $score = 1;
                    break;
                case $systolic_bp <70:
                    $score = 3;
                    break;
            }
        }
        elseif ($age->y >=1){
            switch ($systolic_bp){
                case $systolic_bp >=130:
                    $score = 3;
                    break;
                case $systolic_bp >=120:
                    $score = 2;
                    break;
                case $systolic_bp >=110:
                    $score = 1;
                    break;
                case $systolic_bp >=90:
                    $score = 0;
                    break;
                case $systolic_bp >=80:
                    $score = 1;
                    break;
                case $systolic_bp >=70:
                    $score = 1;
                    break;
                case $systolic_bp <70:
                    $score = 3;
                    break;
            }
        }
        elseif ($age->m >=4){
            switch ($systolic_bp){
                case $systolic_bp >=120:
                    $score = 3;
                    break;
                case $systolic_bp >=110:
                    $score = 2;
                    break;
                case $systolic_bp >=100:
                    $score = 1;
                    break;
                case $systolic_bp >=80:
                    $score = 0;
                    break;
                case $systolic_bp >=70:
                    $score = 1;
                    break;
                case $systolic_bp >=60:
                    $score = 1;
                    break;
                case $systolic_bp <60:
                    $score = 3;
                    break;
            }
        }
        else{
            switch ($systolic_bp){
                case $systolic_bp >=110:
                    $score = 3;
                    break;
                case $systolic_bp >=100:
                    $score = 2;
                    break;
                case $systolic_bp >=80:
                    $score = 1;
                    break;
                case $systolic_bp >=60:
                    $score = 0;
                    break;
                case $systolic_bp >=50:
                    $score = 1;
                    break;
                case $systolic_bp >=45:
                    $score = 1;
                    break;
                case $systolic_bp <45:
                    $score = 3;
                    break;
            }

        }
        return $score;
    }
    private function respRateScore(Assessment $assessment,$age){
        $resp_rate = $assessment->resp_rate;
        $score = 0;
        if($age->y >= 12){
            switch ($resp_rate){
                case $resp_rate>=30:
                    $score = 3;
                    break;
                case $resp_rate>=25:
                    $score = 2;
                    break;
                case $resp_rate >=20:
                    $score = 1;
                    break;
                case $resp_rate>=15:
                    $score = 0;
                    break;
                case $resp_rate >=11:
                    $score = 1;
                    break;

                case $resp_rate <=10:
                    $score = 3;
                    break;
            }
        }
        elseif ($age->y >=5){
            switch ($resp_rate){
                case $resp_rate>=50:
                    $score = 3;
                    break;
                case $resp_rate>=40:
                    $score = 2;
                    break;
                case $resp_rate >=30:
                    $score = 1;
                    break;
                case $resp_rate>=16:
                    $score = 0;
                    break;
                case $resp_rate >=11:
                    $score = 1;
                    break;
//                case $resp_rate >=0:
//                    $score = 2;
//                    break;
                case $resp_rate <10:
                    $score = 3;
                    break;

            }
        }

        elseif ($age->y >=1){
            switch ($resp_rate){
                case $resp_rate>=60:
                    $score = 3;
                    break;
                case $resp_rate>=50:
                    $score = 2;
                    break;
                case $resp_rate >=40:
                    $score = 1;
                    break;
                case $resp_rate>=20:
                    $score = 0;
                    break;
                case $resp_rate >=15:
                    $score = 1;
                    break;
//                case $resp_rate >=0:
//                    $score = 2;
//                    break;
                case $resp_rate <15:
                    $score = 3;
                    break;

            }
        }
        elseif ($age->m >=4){
            switch ($resp_rate){
                case $resp_rate>=70:
                    $score = 3;
                    break;
                case $resp_rate>=60:
                    $score = 2;
                    break;
                case $resp_rate >=50:
                    $score = 1;
                    break;
                case $resp_rate>=30:
                    $score = 0;
                    break;
                case $resp_rate >=16:
                    $score = 1;
                    break;
//                case $resp_rate >=0:
//                    $score = 2;
//                    break;
                case $resp_rate <15:
                    $score = 3;
                    break;

            }
        }
        else{
            switch ($resp_rate){
                case $resp_rate>=80:
                    $score = 3;
                    break;
                case $resp_rate>=70:
                    $score = 2;
                    break;
                case $resp_rate >=60:
                    $score = 1;
                    break;
                case $resp_rate>=30:
                    $score = 0;
                    break;
                case $resp_rate >=20:
                    $score = 1;
                    break;
                case $resp_rate >=16:
                    $score = 2;
                    break;
                case $resp_rate <15:
                    $score = 3;
                    break;

            }
        }
        return $score;
    }
    private function o2SatScore(Assessment $assessment){
        /*
         * spo2 = saturation of partial oxygen
         */
        $spo2 = $assessment->spo2;
        $score = 0;
            switch ($spo2){
                case $spo2>=94:
                    $score = 0;
                    break;
                case $spo2>=90:
                    $score = 1;
                    break;
                case $spo2 >=86:
                    $score = 2;
                    break;
                case $spo2<85:
                    $score = 3;
                    break;
            }
            return $score;

    }
    private function o2FlowRateScore(Assessment $assessment){
        /*
         * o2_liters -> Oxygen flow rate
         */
        $o2_liters = $assessment->o2_liters;
        $score = 0;
        if(strcmp($o2_liters,"<2L")==0){
            $score = 1;
        }
        elseif (strcmp($o2_liters,">2L")==0){
            $score = 2;
        }
    return $score;
    }
    private function respEffort(Assessment $assessment){
        /*
         * Mild , Moderate falls under same category
         */
        $resp_effort = $assessment->resp_effort;
        $score = 0;
        if(strcmp($resp_effort,"mild")==0){
            $score = 1;
        }
        elseif (strcmp($resp_effort,"moderate")==0){
            $score = 1;
        }
        elseif (strcmp($resp_effort,"severe")==0){
            $score = 2;
        }
        return $score;
    }

    public function getAssessmentPrint(Request $request,$assessment_id){
        return $this->calculateScore($assessment_id);
    }
}
