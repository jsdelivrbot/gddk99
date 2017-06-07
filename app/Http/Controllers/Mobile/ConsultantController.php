<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsultantController extends Controller
{
    public function Index(){
       return view('mobile.consultant-details');
    }

    public function ShopDetails(){
        return view('mobile.shop-details');
    }
}
