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
        if($assessment != null){
            $patient = $assessment->patient()->first();
            $admission = $assessment->admission()->first();
//            var_dump($patient);
            if($patient!= null and $admission != null){
                $age = $patient->age();
                $patient['age'] = $age;

                $heart_rate_score = $this->heartRateScore($assessment,$age);
                $systolic_bp_score = $this->systolicBPScore($assessment,$age);
                $resp_rate_score = $this->respRateScore($assessment,$age);
                $o2_sat_score = $this->o2SatScore($assessment);
                $o2_flow_rate_score =$this->o2FlowRateScore($assessment);
                $resp_effort_score = $this->respEffort($assessment);
                $avpu_score = $this->avpuScore($assessment);
                $crft_score = $this->crftScore($assessment);

                $total_score = $heart_rate_score+$systolic_bp_score+$resp_rate_score+$o2_sat_score+$o2_flow_rate_score+$resp_effort_score+$avpu_score+$crft_score;

                $score = array(
                    'heart_rate'=>$heart_rate_score,
                    'systolic_bp' => $systolic_bp_score,
                    'resp_rate' =>$resp_rate_score,
                    'resp_effort'=>$resp_effort_score,
                    'spo2'=> $o2_sat_score,
                    'o2_liters' => $o2_flow_rate_score,
                    'avpu'=>$avpu_score,
                    'crft'=>$crft_score,
                    'total' => $total_score,
                );
                $recomendation = $this->getRecommendation($total_score);
//                echo "O2 Flow rate  : ".$o2_flow_rate_score." Heart Rate Score : ".$heart_rate_score.
//                    " Systolic Bp : ".$systolic_bp_score." Resp Rate  : ".$resp_rate_score." O2 Sat Score : "
//                    .$o2_sat_score. " Resp Effort : ".$resp_effort_score.
//                    " AVPU Score : ".$avpu_score." CRFT Score : ".$crft_score." Total Score : ".$total_score;
                $nurse = $assessment->nurse()->first()->name;

                return view('nurse.forms.printAssessment')
                    ->with(['patient'=>$patient,'assessment'=>$assessment,'score'=>$score,'recomendation'=>$recomendation,'nurse'=>$nurse,'admission'=>$admission]);
            }
            else{
                return abort(404);

            }

        }
        else{
            return abort(404);
        }

    }

    private function heartRateScore(Assessment $assessment,$age){
        $heart_rate = $assessment->heart_rate;
        if($heart_rate== null){
            return 0;
        }
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
        if($systolic_bp== null){
            return 0;
        }

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
        if($resp_rate== null){
            return 0;
        }
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
        if($spo2== null){
            return 0;
        }
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
        if($o2_liters== null){
            return 0;
        }
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
        if($resp_effort== null){
            return 0;
        }
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
    private function avpuScore(Assessment $assessment){
        /*
         * Mild , Moderate falls under same category
         */
        $avpu = $assessment->avpu;
        if($avpu== null){
            return 0;
        }
        $score = 0;
        if(strcmp($avpu,"alert")==0){
            $score = 1;
        }
        elseif (strcmp($avpu,"voice")==0){
            $score = 1;
        }
        elseif (strcmp($avpu,"pain/non")==0){
            $score = 3;
        }
        return $score;
    }
    private function crftScore(Assessment $assessment){
        /*
         * Mild , Moderate falls under same category
         */
        $crft = $assessment->crft;
        if($crft== null){
            return 0;
        }
        $score = 0;
        if(strcmp($crft,"<2sec")==0){
            $score = 0;
        }
        elseif (strcmp($crft,">2sec")==0){
            $score = 1;
        }
        else{
            return abort(404);
        }
        return $score;
    }

    private function getRecommendation($total_score){
        $recommendation = array();
        switch ($total_score){
            case 1 :
                $recommendation['observe_frequency'] = '4 Hourly';
                $recommendation['whom_to_alert'] = ' ';
                $recommendation['response'] = 'to review room';
                $recommendation['color_code'] = 'green';
                break;
            case 2 :
                $recommendation['observe_frequency'] = '2 to 4 Hourly';
                $recommendation['whom_to_alert'] = ' ';
                $recommendation['response'] = 'To review room';
                $recommendation['color_code'] = 'green';

                break;
            case 3 :
                $recommendation['observe_frequency'] = '1 Hourly';
                $recommendation['whom_to_alert'] = ' Alert Medical Officer';
                $recommendation['response'] = 'To observation bed';
                $recommendation['color_code'] = 'blue';

                break;
            case 4 or 5 :
                $recommendation['observe_frequency'] = '30 Minutes';
                $recommendation['whom_to_alert'] = ' Alert Medical Officer';
                $recommendation['response'] = 'To observation bed';
                $recommendation['color_code'] = 'blue';

                break;
            case 6 :
                $recommendation['observe_frequency'] = 'continuous';
                $recommendation['whom_to_alert'] = ' Alert MO + consultant';
                $recommendation['response'] = 'Argent senior medical review';
                $recommendation['color_code'] = 'red';

                break;
            case $total_score >= 7 :
                $recommendation['observe_frequency'] = 'continuous';
                $recommendation['whom_to_alert'] = 'Urgent PEWS call*';
                $recommendation['response'] = 'Immediate local response team';
                $recommendation['color_code'] = 'red';

                break;
        }
        return $recommendation;
    }

    public function getAssessmentPrint(Request $request,$assessment_id){
        return $this->calculateScore($assessment_id);
    }
}
