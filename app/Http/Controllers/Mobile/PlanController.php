<?php

namespace App\Http\Controllers\Mobile;

use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function Detail($id){
        $plan =Plan::find($id);
        return view('mobile.plan-details',['plan'=>$plan]);
    }
}
