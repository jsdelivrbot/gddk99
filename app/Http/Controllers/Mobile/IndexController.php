<?php

namespace App\Http\Controllers\Mobile;

use App\Consultant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        $consultant = Consultant::where('con_type',1)->paginate(15);
        $shop = Consultant::where('con_type',2)->paginate(15);
        return view('mobile.index',['consultant'=>$consultant,'shop'=>$shop]);
    }

    public function FullContent(){
        return view('mobile.full-content');
    }

}
