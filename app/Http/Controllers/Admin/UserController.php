<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function UserList(){
        return view('admin.user-list');
    }

    public function UnionList(){
        return view('admin.union-list');
    }
}
