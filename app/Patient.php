<?php

namespace App;

use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //

    public function age(){

        $age = 0;
        date_default_timezone_set('Asia/Colombo');
//        $d1 = new DateTime('2011-03-12');
//        $now = date('d-m-Y');
        $now = $this->created_at;
        $d1 = new \DateTime($now);
        $d2 = new \DateTime($this->birthday);

        $diff = $d2->diff($d1);
        return $diff;
    }

    public function assessments(){
        return $this->hasMany('App\Assessment');
    }
    public function nurse(){
        return $this->belongsTo('App\Nurse');
    }
    public function admissions(){
        return $this->hasMany('App\Admissions');
    }
}
