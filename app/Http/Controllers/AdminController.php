<?php

namespace App\Http\Controllers;

use App\Nurse;
use App\NurseAccountStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Hamcrest\Text\IsEqualIgnoringCase;


class AdminController extends Controller
{
    //
    public function showNurseAccounts(Request $request){
        /*
         * Returns all the nurse account details
         */
        $nurses = DB::table('nurses')->select("id","name","username","status","created_at","updated_at")->get();

        return view("admin.nurseControl.accounts",['nurses'=>$nurses]);
    }
    public function alterNurseAccounts(Request $request){

        $nurse_update_log = new NurseAccountStatus();
        $nurse_update_log->admin_id = Auth::guard('admin')->user()->id;
        $nurse = Nurse::where("id",$request->nurse_id)->first();
        if(strcmp($nurse->status,"active")==0){
            $nurse->status = "inactive";
            $nurse_update_log->old_status = "active";

        }
        else{
            $nurse->status = "active";
            $nurse_update_log->old_status = "inactive";

        }
        $nurse->save();
        return redirect("/admin/update/nurse/accounts");
    }
}
