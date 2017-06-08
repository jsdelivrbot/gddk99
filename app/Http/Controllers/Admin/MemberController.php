<?php

namespace App\Http\Controllers\Admin;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function MemberList(){
        $member = Member::paginate(15);
        return view('admin.member-list',['member' =>$member ]);
    }

    public function UnionList(){
        return view('admin.union-list');
    }
}
