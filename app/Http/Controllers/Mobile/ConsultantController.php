<?php

namespace App\Http\Controllers\Mobile;

use App\Consultant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsultantController extends Controller
{
    public function Index($id){
        $consultant = Consultant::find($id);
       return view('mobile.consultant-details',['consultant'=>$consultant]);
    }

    public function ShopDetails($id){
        $shop = Consultant::find($id);
        return view('mobile.shop-details',['shop'=>$shop]);
    }
}
