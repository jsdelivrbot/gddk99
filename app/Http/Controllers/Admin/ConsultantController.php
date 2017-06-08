<?php

namespace App\Http\Controllers\Admin;

use App\Consultant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Redirect;

class ConsultantController extends Controller
{
    // 顾客
    public function ConsultantList(){
        $consultant = Consultant::where('con_type',1)->paginate(15);
        return view('admin.consultant-list',['consultant' => $consultant]);
    }

    public function ConsultantStore(){
        return view('admin.consultant-store');
    }

    public function ConsultantStoreOk(Request $request){

        $conPic = $request->file('con_pic');
        $conName = $request->get('con_name');
        $conWxPic = $request->file('con_wx_pic');
        $conTel = $request->get('con_tel');
        $conPerson = $request->get('con_person');
        $conTime = $request->get('con_time');
        $conPicAll = $request->file('con_pic_all');
        $conContent = $request->get('con_content');
        $conContentArea = $request->get('con_content_area');
        $conContentRange = $request->get('con_content_range');
        $conAdd = $request->get('con_add');

        if($request->isMethod('POST'))
        {
            $file = $conPic;
            $filewx = $conWxPic;
            $fileall =$conPicAll;

            // 上传多个图片方法
            if ($fileall){
                foreach ($fileall as $file_val){
                    $ext_all = $file_val->getClientOriginalExtension();
                    $realPath_all = $file_val->getRealPath();
                    $filename_all = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext_all;
                    Storage::disk('uploads')->put($filename_all,file_get_contents($realPath_all));
                    $filename_all_array[] =$filename_all;
                }
                $filename_all_store = serialize($filename_all_array);
            }

            // 上传单个图片方法
            if($file)
            {
                $ext = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
                Storage::disk('uploads')->put($filename,file_get_contents($realPath));

                $ext_wx = $filewx->getClientOriginalExtension();
                $realPath_wx = $filewx->getRealPath();
                $filename_wx = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext_wx;
                Storage::disk('uploads')->put($filename_wx,file_get_contents($realPath_wx));

                //实例化，保存数据
               $consultant = new Consultant();
               $consultant ->con_pic = $filename;
               $consultant ->con_name = $conName;
               $consultant ->con_wx_pic = $filename_wx;
               $consultant ->con_tel = $conTel;
               $consultant ->con_person = $conPerson;
               $consultant ->con_time = $conTime;
               $consultant ->con_pic_all = $filename_all_store;
               $consultant ->con_content = $conContent;
               $consultant ->con_content_area = $conContentArea;
               $consultant ->con_content_range = $conContentRange;
               $consultant ->con_add = $conAdd;
               $consultant ->con_type = 1;
               $consultant ->save();
            }
            return redirect('/admin/consultant-list');
        }

    }

    public function ConsultantEdit($id){
        $consultant = Consultant::find($id);
        return view('admin.consultant-edit',['consultant'=>$consultant]);
    }

    public function ConsultantEditOk(Request $request){
        $conId = $request->get('con_id');
        $conPic = $request->file('con_pic');
        $conName = $request->get('con_name');
        $conWxPic = $request->file('con_wx_pic');
        $conTel = $request->get('con_tel');
        $conPerson = $request->get('con_person');
        $conTime = $request->get('con_time');
        $conPicAll = $request->file('con_pic_all');
        $conContent = $request->get('con_content');
        $conContentArea = $request->get('con_content_area');
        $conContentRange = $request->get('con_content_range');
        $conAdd = $request->get('con_add');

        if($request->isMethod('POST'))
        {
            $file = $conPic;
            $filewx = $conWxPic;
            $fileall =$conPicAll;

            // 上传多个图片方法--更新
            if ($fileall){
                foreach ($fileall as $file_val){
                    $ext_all = $file_val->getClientOriginalExtension();
                    $realPath_all = $file_val->getRealPath();
                    $filename_all = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext_all;
                    Storage::disk('uploads')->put($filename_all,file_get_contents($realPath_all));
                    $filename_all_array[] =$filename_all;
                }
                $filename_all_store = serialize($filename_all_array);
                $consultant = Consultant::find($conId);

                foreach (unserialize($consultant['con_pic_all']) as $basicList){
                    if(!empty($basicList)){
                        $images = public_path('build/uploads/') . $basicList;
                        if (file_exists ($images )) {
                            unlink ($images);
                        }
                    }
                }
            }else{
                $consultant = Consultant::find($conId);
                $filename_all_store = $consultant['con_pic_all'];
            }

            // 上传单个图片方法
            if($file)
            {
                $ext = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
                Storage::disk('uploads')->put($filename,file_get_contents($realPath));

                $ext_wx = $filewx->getClientOriginalExtension();
                $realPath_wx = $filewx->getRealPath();
                $filename_wx = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext_wx;
                Storage::disk('uploads')->put($filename_wx,file_get_contents($realPath_wx));

                //实例化，保存数据
                $consultant = Consultant::find($conId);
                if(!empty($consultant['con_pic'])){
                    $images = public_path('build/uploads/') . $consultant['con_pic'];
                    if (file_exists ($images )) {
                        unlink ($images);
                    }
                }
                if(!empty($consultant['con_wx_pic'])){
                    $images = public_path('build/uploads/') . $consultant['con_wx_pic'];
                    if (file_exists ($images )) {
                        unlink ($images);
                    }
                }
                $consultant ->con_pic = $filename;
                $consultant ->con_name = $conName;
                $consultant ->con_wx_pic = $filename_wx;
                $consultant ->con_tel = $conTel;
                $consultant ->con_person = $conPerson;
                $consultant ->con_time = $conTime;
                $consultant ->con_pic_all = $filename_all_store;
                $consultant ->con_content = $conContent;
                $consultant ->con_content_area = $conContentArea;
                $consultant ->con_content_range = $conContentRange;
                $consultant ->con_add = $conAdd;
                $consultant ->save();
            }else{
                $consultant = Consultant::find($conId);
                $consultant ->con_name = $conName;
                $consultant ->con_tel = $conTel;
                $consultant ->con_person = $conPerson;
                $consultant ->con_time = $conTime;
                $consultant ->con_content = $conContent;
                $consultant ->con_content_area = $conContentArea;
                $consultant ->con_content_range = $conContentRange;
                $consultant ->con_add = $conAdd;
                $consultant ->save();
            }
            return redirect('/admin/consultant-list');
        }
    }

    public function ConsultantDel($id){
        $conId =Consultant::find($id);
        foreach (unserialize($conId['con_pic_all']) as $basicList){
            if(!empty($basicList)){
                $images = public_path('build/uploads/') . $basicList;
                if (file_exists ($images )) {
                    unlink ($images);
                }
            }
        }
        if(!empty($conId['con_pic'])){
            $images = public_path('build/uploads/') . $conId['con_pic'];
            if (file_exists ($images )) {
                unlink ($images);
            }
        }
        if(!empty($conId['con_wx_pic'])){
            $images = public_path('build/uploads/') . $conId['con_wx_pic'];
            if (file_exists ($images )) {
                unlink ($images);
            }
        }
        $conId->delete();
        return Redirect::back();
    }

    // 店铺
    public function ShopList(){
        $consultant = Consultant::where('con_type',2)->paginate(15);
        return view('admin.shop-list',['consultant' => $consultant]);
    }

    public function ShopStore(){
        return view('admin.shop-store');
    }

    public function ShopStoreOk(Request $request){

        $conPic = $request->file('con_pic');
        $conName = $request->get('con_name');
        $conWxPic = $request->file('con_wx_pic');
        $conTel = $request->get('con_tel');
        $conPerson = $request->get('con_person');
        $conTime = $request->get('con_time');
        $conPicAll = $request->file('con_pic_all');
        $conContent = $request->get('con_content');
        $conContentArea = $request->get('con_content_area');
        $conContentRange = $request->get('con_content_range');
        $conAdd = $request->get('con_add');

        if($request->isMethod('POST'))
        {
            $file = $conPic;
            $filewx = $conWxPic;
            $fileall =$conPicAll;

            // 上传多个图片方法
            if ($fileall){
                foreach ($fileall as $file_val){
                    $ext_all = $file_val->getClientOriginalExtension();
                    $realPath_all = $file_val->getRealPath();
                    $filename_all = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext_all;
                    Storage::disk('uploads')->put($filename_all,file_get_contents($realPath_all));
                    $filename_all_array[] =$filename_all;
                }
                $filename_all_store = serialize($filename_all_array);
            }

            // 上传单个图片方法
            if($file)
            {
                $ext = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
                Storage::disk('uploads')->put($filename,file_get_contents($realPath));

                $ext_wx = $filewx->getClientOriginalExtension();
                $realPath_wx = $filewx->getRealPath();
                $filename_wx = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext_wx;
                Storage::disk('uploads')->put($filename_wx,file_get_contents($realPath_wx));

                //实例化，保存数据
                $consultant = new Consultant();
                $consultant ->con_pic = $filename;
                $consultant ->con_name = $conName;
                $consultant ->con_wx_pic = $filename_wx;
                $consultant ->con_tel = $conTel;
                $consultant ->con_person = $conPerson;
                $consultant ->con_time = $conTime;
                $consultant ->con_pic_all = $filename_all_store;
                $consultant ->con_content = $conContent;
                $consultant ->con_content_area = $conContentArea;
                $consultant ->con_content_range = $conContentRange;
                $consultant ->con_add = $conAdd;
                $consultant ->con_type = 2;
                $consultant ->save();
            }
            return redirect('/admin/shop-list');
        }

    }

    public function ShopEdit($id){
        $consultant = Consultant::find($id);
        return view('admin.shop-edit',['consultant'=>$consultant]);
    }

    public function ShopEditOk(Request $request){
        $conId = $request->get('con_id');
        $conPic = $request->file('con_pic');
        $conName = $request->get('con_name');
        $conWxPic = $request->file('con_wx_pic');
        $conTel = $request->get('con_tel');
        $conPerson = $request->get('con_person');
        $conTime = $request->get('con_time');
        $conPicAll = $request->file('con_pic_all');
        $conContent = $request->get('con_content');
        $conContentArea = $request->get('con_content_area');
        $conContentRange = $request->get('con_content_range');
        $conAdd = $request->get('con_add');

        if($request->isMethod('POST'))
        {
            $file = $conPic;
            $filewx = $conWxPic;
            $fileall =$conPicAll;

            // 上传多个图片方法--更新
            if ($fileall){
                foreach ($fileall as $file_val){
                    $ext_all = $file_val->getClientOriginalExtension();
                    $realPath_all = $file_val->getRealPath();
                    $filename_all = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext_all;
                    Storage::disk('uploads')->put($filename_all,file_get_contents($realPath_all));
                    $filename_all_array[] =$filename_all;
                }
                $filename_all_store = serialize($filename_all_array);
                $consultant = Consultant::find($conId);

                foreach (unserialize($consultant['con_pic_all']) as $basicList){
                    if(!empty($basicList)){
                        $images = public_path('build/uploads/') . $basicList;
                        if (file_exists ($images )) {
                            unlink ($images);
                        }
                    }
                }
            }else{
                $consultant = Consultant::find($conId);
                $filename_all_store = $consultant['con_pic_all'];
            }

            // 上传单个图片方法
            if($file)
            {
                $ext = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
                Storage::disk('uploads')->put($filename,file_get_contents($realPath));

                $ext_wx = $filewx->getClientOriginalExtension();
                $realPath_wx = $filewx->getRealPath();
                $filename_wx = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext_wx;
                Storage::disk('uploads')->put($filename_wx,file_get_contents($realPath_wx));

                //实例化，保存数据
                $consultant = Consultant::find($conId);
                if(!empty($consultant['con_pic'])){
                    $images = public_path('build/uploads/') . $consultant['con_pic'];
                    if (file_exists ($images )) {
                        unlink ($images);
                    }
                }
                if(!empty($consultant['con_wx_pic'])){
                    $images = public_path('build/uploads/') . $consultant['con_wx_pic'];
                    if (file_exists ($images )) {
                        unlink ($images);
                    }
                }
                $consultant ->con_pic = $filename;
                $consultant ->con_name = $conName;
                $consultant ->con_wx_pic = $filename_wx;
                $consultant ->con_tel = $conTel;
                $consultant ->con_person = $conPerson;
                $consultant ->con_time = $conTime;
                $consultant ->con_pic_all = $filename_all_store;
                $consultant ->con_content = $conContent;
                $consultant ->con_content_area = $conContentArea;
                $consultant ->con_content_range = $conContentRange;
                $consultant ->con_add = $conAdd;
                $consultant ->save();
            }else{
                $consultant = Consultant::find($conId);
                $consultant ->con_name = $conName;
                $consultant ->con_tel = $conTel;
                $consultant ->con_person = $conPerson;
                $consultant ->con_time = $conTime;
                $consultant ->con_content = $conContent;
                $consultant ->con_content_area = $conContentArea;
                $consultant ->con_content_range = $conContentRange;
                $consultant ->con_add = $conAdd;
                $consultant ->save();
            }
            return redirect('/admin/shop-list');
        }
    }

    public function ShopDel($id){
        $conId =Consultant::find($id);
        foreach (unserialize($conId['con_pic_all']) as $basicList){
            if(!empty($basicList)){
                $images = public_path('build/uploads/') . $basicList;
                if (file_exists ($images )) {
                    unlink ($images);
                }
            }
        }
        if(!empty($conId['con_pic'])){
            $images = public_path('build/uploads/') . $conId['con_pic'];
            if (file_exists ($images )) {
                unlink ($images);
            }
        }
        if(!empty($conId['con_wx_pic'])){
            $images = public_path('build/uploads/') . $conId['con_wx_pic'];
            if (file_exists ($images )) {
                unlink ($images);
            }
        }        $conId->delete();
        return Redirect::back();
    }

}
