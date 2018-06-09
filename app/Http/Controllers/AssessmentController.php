<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\Patient;
use Illuminate\Http\Request;
use Validator;

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

                return ['patient'=>$patient,'assessment'=>$assessment,'score'=>$score,'recomendation'=>$recomendation,'nurse'=>$nurse,'admission'=>$admission];
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
        switch (true){
            case $total_score == 1 :
                $recommendation['observe_frequency'] = '4 Hourly';
                $recommendation['whom_to_alert'] = ' ';
                $recommendation['response'] = 'to review room';
                $recommendation['color_code'] = 'green';
                break;
            case $total_score == 2 :
                $recommendation['observe_frequency'] = '2 to 4 Hourly';
                $recommendation['whom_to_alert'] = ' ';
                $recommendation['response'] = 'To review room';
                $recommendation['color_code'] = 'green';
                break;
            case $total_score == 3 :
                $recommendation['observe_frequency'] = '1 Hourly';
                $recommendation['whom_to_alert'] = ' Alert Medical Officer';
                $recommendation['response'] = 'To observation bed';
                $recommendation['color_code'] = 'blue';
                break;
            case $total_score == 4 or $total_score == 5 :
                $recommendation['observe_frequency'] = '30 Minutes';
                $recommendation['whom_to_alert'] = ' Alert Medical Officer';
                $recommendation['response'] = 'To observation bed';
                $recommendation['color_code'] = 'blue';

                break;
            case $total_score == 6 :
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
        return view('nurse.forms.printAssessment')
            ->with($this->calculateScore($assessment_id));
    }


    public function getCriticalAssessments(){
        $assessments = Assessment::where("discharge","false")
//            ->whereRaw("DATEDIFF(NOW(),created_at)<=2")               //TODO uncomment in mysql production server
            ->orderBy("created_at","DESC")->get();

        $score_calculated = array();
        foreach ($assessments as $assessment){
            array_push($score_calculated,$this->calculateScore($assessment->id));
        }

        $critically_sorted = array_reverse($this->insertion_Sort($score_calculated));
//        var_dump( $critically_sorted);

        return $critically_sorted;
    }


    function insertion_Sort($my_array)
    {
        $length = count($my_array);
        for($i=0;$i<$length;$i++){
            $val = $my_array[$i]["score"]["total"];
            $j = $i-1;
            while($j>=0 && $my_array[$j]["score"]["total"] > $val){
                $my_array[$j+1]["score"]["total_score"] = $my_array[$j]["score"]["total"];
                $j--;
            }
            $my_array[$j+1]["score"]["total"] = $val;
        }
        return $my_array;
    }

    public function dischargeAssessment(Request $request,$assessment_id){

        $assessment = Assessment::where("id",$assessment_id)->first();
        if($assessment == null){
            return abort(404);
        }
        $assessment->discharge = "true";
        $assessment->discharge_note = $request->discharge_note;
        $assessment->condition = $request->condition;
//        echo $assessment;
        $assessment->save();
        return redirect("/nurse/home");
    }


    public function getPatientRegister(Request $request,$start_date,$end_date){
        $start = date('Y-m-d',strtotime($start_date));
        $end = date('Y-m-d',strtotime($end_date));

//        echo $start;
        $assessments = Assessment::where("created_at",">=",$start)
//            ->where("discharge","true")
            ->where("created_at","<=",$end)
            ->orderBy("patient_id")
            ->orderBy("created_at","ASC")->get();
        if ($assessments ==null){
            return abort(404);
        }
        $score_calculated = array();
        foreach ($assessments as $assessment){
            array_push($score_calculated,$this->calculateScore($assessment->id));
        }
        return view("nurse.forms.admissionRegister")->with(['records'=>$score_calculated]);
//        return $score_calculated;
    }

    public function getRegister(Request $request){

        $this->validator($request->all())->validate();
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        return redirect("nurse/patient/register/".$start_date."/".$end_date);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'start_date' => 'required|date',
            'end_date' => 'required|date',

        ]);
    }

}
