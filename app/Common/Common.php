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

  //生成海报方法：png
  public function Poster($backgrond,$qrcode,$path){
      header('Content-type:image/png');

      $path_1 = $backgrond;
      $path_2 = $qrcode;

      $image_1 = imagecreatefrompng($path_1);
      $image_2 = imagecreatefrompng($path_2);
      $image_3 = imageCreatetruecolor(imagesx($image_1),imagesy($image_1));
      $color = imagecolorallocate($image_3, 255, 255, 255);
      imagefill($image_3, 0, 0, $color);
      imageColorTransparent($image_3, $color);
      imagecopyresampled($image_3,$image_1,0,0,0,0,imagesx($image_1),imagesy($image_1),imagesx($image_1),imagesy($image_1));
      imagecopymerge($image_3,$image_2, 210,440,0,0,imagesx($image_2),imagesy($image_2), 100);

      imagepng($image_3,$path);
      imagedestroy($image_3);
      imagedestroy($image_2);
  }

}