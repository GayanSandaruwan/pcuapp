<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    //
    public function patient(){
        return $this->belongsTo('App\Patient');
    }
    public function nurse(){
        return $this->belongsTo('App\Nurse');
    }
}
