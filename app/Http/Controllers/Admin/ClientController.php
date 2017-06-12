<?php

namespace App\Http\Controllers\Admin;

use App\Info;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function Index(){
        $client_info = Info::paginate(15);
        return view('admin.client-list',['client_info'=>$client_info]);
    }
}
