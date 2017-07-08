<?php

namespace App\Http\Controllers\Admin;

use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function Index(Plan $plan){
        $plans = $plan->paginate(15);
        $planType = $plan->planType();
        return view('admin.plan-list',['plan'=>$plans,'planType'=>$planType]);
    }

    public function Insert(Plan $plan){
        $planType =$plan->planType();
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

    public function Update($id,Plan $plan){
        $plans = $plan->find($id);
        $planType =$plan->planType();
        return view('admin.plan-update',['plan'=>$plans,'planType'=>$planType]);
    }

    public function UpdateStore(Request $request,Plan $plan){

        $data = $request->except(['_token']);
        $result = $plan->where('id',$data['id'])->update(array_except($data,['id']));

        if ($result){
            return redirect('/admin/plan-list')->with('message', '1');
        }else{
            return redirect('/admin/plan-list')->with('message', '0');
        }
    }

}
