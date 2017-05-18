<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        return view('mobile.index');
    }

    public function FullContent(){
        return view('mobile.full-content');
    }

    public function Person(){
        return view('mobile.person-list');
    }
}
