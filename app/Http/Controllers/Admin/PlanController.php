<?php

namespace App\Http\Controllers\Admin;

use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function Index(){
        $plan = Plan::paginate(15);
        $planType =(new Plan())->planType();
        return view('admin.plan-list',['plan'=>$plan,'planType'=>$planType]);
    }

    public function Insert(){
        $planType =(new Plan())->planType();
        return view('admin.plan-insert',['planType'=>$planType]);
    }

    public function InsertStore(Request $request){
       $result = Plan::create(array_merge($request->all()));
       if ($result){
           return redirect('/admin/plan-list')->with('message', '1');
       }else{
           return redirect('/admin/plan-list')->with('message', '0');
       }
    }

    public function Update($id){
        $plan = Plan::find($id);
        $planType =(new Plan())->planType();
        return view('admin.plan-update',['plan'=>$plan,'planType'=>$planType]);
    }

    public function UpdateStore(Request $request){
        $id = $request->get('id');
        $plan_title = $request->get('plan_title');
        $plan_title_a = $request->get('plan_title_a');
        $plan_title_b = $request->get('plan_title_b');
        $plan_title_c = $request->get('plan_title_c');
        $plan_title_d = $request->get('plan_title_d');
        $plan_title_e = $request->get('plan_title_e');
        $plan_title_f = $request->get('plan_title_f');
        $plan_title_g = $request->get('plan_title_g');
        $plan_title_h = $request->get('plan_title_h');

        $plan_con_a = $request->get('plan_con_a');
        $plan_con_b = $request->get('plan_con_b');
        $plan_con_c = $request->get('plan_con_c');

        $plan_type_a = $request->get('plan_type_a');
        $plan_type_b = $request->get('plan_type_b');
        $plan_type_c = $request->get('plan_type_c');

        $plan = Plan::find($id);
        $plan->plan_title =$plan_title;
        $plan->plan_title_a =$plan_title_a;
        $plan->plan_title_b =$plan_title_b;
        $plan->plan_title_c =$plan_title_c;
        $plan->plan_title_d =$plan_title_d;
        $plan->plan_title_e =$plan_title_e;
        $plan->plan_title_f =$plan_title_f;
        $plan->plan_title_g =$plan_title_g;
        $plan->plan_title_h =$plan_title_h;

        $plan->plan_con_a =$plan_con_a;
        $plan->plan_con_b =$plan_con_b;
        $plan->plan_con_c =$plan_con_c;

        $plan->plan_type_a =$plan_type_a;
        $plan->plan_type_b =empty($plan_type_b)? 0:$plan_type_b;
        $plan->plan_type_c =empty($plan_type_c)? 0:$plan_type_c;

        if ($plan->save()){
            return redirect('/admin/plan-list')->with('message', '1');
        }else{
            return redirect('/admin/plan-list')->with('message', '0');
        }
    }

}
