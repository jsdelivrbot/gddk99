<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtherController extends Controller
{
    public function Index(){
        return view('mobile.serve');
    }
}
