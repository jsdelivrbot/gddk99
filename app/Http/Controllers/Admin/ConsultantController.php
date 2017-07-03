<?php

namespace App\Http\Controllers\Admin;

use App\Common\Common;
use App\Consultant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Redirect;

class ConsultantController extends Controller
{
    // 顾问列表
    public function ConsultantList(){
        $consultant = Consultant::where('con_type',1)->paginate(15);
        return view('admin.consultant-list',['consultant' => $consultant]);
    }

    // 顾问列表--存储
    public function ConsultantStore(){
        return view('admin.consultant-store');
    }

    // 顾问列表--存储--成功
    public function ConsultantStoreOk(Request $request,Common $common,Consultant $consultant){

        // 接收参数
        $data = $request->except(['_token','con_pic','con_wx_pic','con_pic_all']);

        if($request->isMethod('POST'))
        {
            // 上传图片
            $avatar =$common->If_val($common->FileOne($request->file('con_pic')));
            $qrcode =$common->If_val($common->FileOne($request->file('con_wx_pic')));
            $much =$common->If_val($common->FileAll($request->file('con_pic_all')));

            // 组装数据
            $arr = array_merge($data,['con_type'=>Consultant::CON_TYPE_ONE,'con_pic'=>$avatar,'con_wx_pic'=>$qrcode,'con_pic_all'=>$much]);

            // 保存数据
            $consultant->create($arr);

            return redirect('/admin/consultant-list');

        }

    }

    // 顾问列表--存储---更新
    public function ConsultantEdit($id){
        $consultant = Consultant::find($id);
        return view('admin.consultant-edit',['consultant'=>$consultant]);
    }

    // 顾问列表--存储---更新---成功
    public function ConsultantEditOk(Request $request,Common $common,Consultant $consultant){

        // 接收参数
        $data = $request->except(['_token','con_pic','con_wx_pic','con_pic_all','con_id']);
        $data_id = $request->get('con_id');

        if($request->isMethod('POST'))
        {
            // 上传图片
            $avatar =$common->If_val($common->FileOne($request->file('con_pic')));
            $qrcode =$common->If_val($common->FileOne($request->file('con_wx_pic')));
            $much =$common->If_val($common->FileAll($request->file('con_pic_all')));

            $con = $consultant->find($data_id);

            // 判断头像是否是空，为空不替换头像，不为空替换头像-------------单张图片
            if (empty($avatar)){

                // 更新数据--为空
                $consultant->where('id',$data_id)->update($data);
            }else{
                // 删除替换目录图片
                $common->DataPic($avatar,$con['con_pic']);

                // 组装数据
                $arr = array_merge($data,['con_pic'=>$avatar]);

                // 更新数据--不为空
                $consultant->where('id',$data_id)->update($arr);
            }

            // 判断二维码是否是空，为空不替换二维码，不为空替换二维码----------单张图片
            if (empty($qrcode)){

                // 更新数据--为空
                $consultant->where('id',$data_id)->update($data);
            }else{
                // 删除替换目录图片
                $common->DataPic($qrcode,$con['con_wx_pic']);

                // 组装数据
                $arr = array_merge($data,['con_wx_pic'=>$qrcode]);

                // 更新数据--不为空
                $consultant->where('id',$data_id)->update($arr);
            }

            // 判断店铺图片是否是空，为空不替换店铺图片，不为空替换店铺图片----------多张图片
            if (empty($much)){

                // 更新数据--为空
                $consultant->where('id',$data_id)->update($data);
            }else{
                // 删除替换目录图片
                $common->DataPicAllJson($much,$con['con_pic_all']);

                // 组装数据
                $arr = array_merge($data,['con_pic_all'=>$much]);

                // 更新数据--不为空
                $consultant->where('id',$data_id)->update($arr);
            }

            return redirect('/admin/consultant-list');
        }

    }


    // 顾问列表--删除---成功
    public function ConsultantDel($id,Consultant $consultant,Common $common){
        $conId = $consultant->find($id);

        $common->DataPicDel($conId['con_pic']);
        $common->DataPicDelAll($conId['con_pic_all']);
        $common->DataPicDel($conId['con_wx_pic']);

        $conId->delete();
        return Redirect::back();
    }

    // 店铺列表
    public function ShopList(){
        $consultant = Consultant::where('con_type',2)->paginate(15);
        return view('admin.shop-list',['consultant' => $consultant]);
    }

    // 店铺列表--存储
    public function ShopStore(){
        return view('admin.shop-store');
    }

    // 店铺列表--存储---存储---成功
    public function ShopStoreOk(Request $request,Common $common,Consultant $consultant){

        // 接收参数
        $data = $request->except(['_token','con_pic','con_wx_pic','con_pic_all']);

        if($request->isMethod('POST'))
        {
            // 上传图片
            $avatar =$common->If_val($common->FileOne($request->file('con_pic')));
            $qrcode =$common->If_val($common->FileOne($request->file('con_wx_pic')));
            $much =$common->If_val($common->FileAll($request->file('con_pic_all')));

            // 组装数据
            $arr = array_merge($data,['con_type'=>Consultant::CON_TYPE_TWO,'con_pic'=>$avatar,'con_wx_pic'=>$qrcode,'con_pic_all'=>$much]);

            // 保存数据
            $consultant->create($arr);

            return redirect('/admin/shop-list');
        }

    }

    // 店铺列表--存储---更新
    public function ShopEdit($id){
        $consultant = Consultant::find($id);
        return view('admin.shop-edit',['consultant'=>$consultant]);
    }

    // 店铺列表--存储---更新---成功
    public function ShopEditOk(Request $request,Common $common,Consultant $consultant){

        // 接收参数
        $data = $request->except(['_token','con_pic','con_wx_pic','con_pic_all','con_id']);
        $data_id = $request->get('con_id');

        if($request->isMethod('POST'))
        {
            // 上传图片
            $avatar =$common->If_val($common->FileOne($request->file('con_pic')));
            $qrcode =$common->If_val($common->FileOne($request->file('con_wx_pic')));
            $much =$common->If_val($common->FileAll($request->file('con_pic_all')));

            $con = $consultant->find($data_id);

            // 判断头像是否是空，为空不替换头像，不为空替换头像-------------单张图片
            if (empty($avatar)){

                // 更新数据--为空
                $consultant->where('id',$data_id)->update($data);
            }else{
                // 删除替换目录图片
                $common->DataPic($avatar,$con['con_pic']);

                // 组装数据
                $arr = array_merge($data,['con_pic'=>$avatar]);

                // 更新数据--不为空
                $consultant->where('id',$data_id)->update($arr);
            }

            // 判断二维码是否是空，为空不替换二维码，不为空替换二维码----------单张图片
            if (empty($qrcode)){

                // 更新数据--为空
                $consultant->where('id',$data_id)->update($data);
            }else{
                // 删除替换目录图片
                $common->DataPic($qrcode,$con['con_wx_pic']);

                // 组装数据
                $arr = array_merge($data,['con_wx_pic'=>$qrcode]);

                // 更新数据--不为空
                $consultant->where('id',$data_id)->update($arr);
            }

            // 判断店铺图片是否是空，为空不替换店铺图片，不为空替换店铺图片----------多张图片
            if (empty($much)){

                // 更新数据--为空
                $consultant->where('id',$data_id)->update($data);
            }else{
                // 删除替换目录图片
                $common->DataPicAllJson($much,$con['con_pic_all']);

                // 组装数据
                $arr = array_merge($data,['con_pic_all'=>$much]);

                // 更新数据--不为空
                $consultant->where('id',$data_id)->update($arr);
            }

            return redirect('/admin/shop-list');
        }
    }

    // 店铺列表--删除---成功
    public function ShopDel($id,Consultant $consultant,Common $common){
        $conId = $consultant->find($id);

        $common->DataPicDel($conId['con_pic']);
        $common->DataPicDelAll($conId['con_pic_all']);
        $common->DataPicDel($conId['con_wx_pic']);

        $conId->delete();
        return Redirect::back();
    }

}
