<?php
namespace App\Common;

use Illuminate\Support\Facades\Storage;

class Common
{
   public $upload ="uploads";

    // 上传多个图片方法
   public function FileAll($val){
       $filename_all_store="";
       if (!empty($val)){
           foreach ($val as $file_val){
               $ext_all = $file_val->getClientOriginalExtension();
               $realPath_all = $file_val->getRealPath();
               $filename_all = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext_all;
               Storage::disk($this->upload)->put($filename_all,file_get_contents($realPath_all));
               $filename_all_array[] =$filename_all;
           }
           $filename_all_store = serialize($filename_all_array);
       }
       return $filename_all_store;
   }

    // 上传单个图片方法
  public function FileOne($val){
      $filename="";
       if (!empty($val)){
           $ext = $val->getClientOriginalExtension();
           $realPath = $val->getRealPath();
           $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
           Storage::disk($this->upload)->put($filename,file_get_contents($realPath));
       }
       return $filename;
  }

}