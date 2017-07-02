<?php

namespace App\Http\Controllers\Mobile;

use App\Consultant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{

    // 门店列表详情
    public function ShopDetails($id){
        $shop = Consultant::find($id);
        return view('mobile.shop.shop-details',['shop'=>$shop]);
    }

}
