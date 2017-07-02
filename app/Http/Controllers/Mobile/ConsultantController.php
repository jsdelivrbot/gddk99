<?php

namespace App\Http\Controllers\Mobile;

use App\Consultant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsultantController extends Controller
{

    // 顾客列表详情
    public function Index($id){
        $consultant = Consultant::find($id);
       return view('mobile.consultant.consultant-details',['consultant'=>$consultant]);
    }

}
