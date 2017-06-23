<?php
namespace App\Common;

use Illuminate\Support\Facades\Storage;
use Cache;

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


    // 极速数据短信类方法
    public function Send_sms($phone){

        $appkey = env('JS_APP_KEY');//你的appkey
        $mobile = $phone;//手机号 超过1024请用POST
        $rand=rand(1000,9999);
        $content = '尊敬的用户您好，您的短信验证码为'.$rand.'，5分钟内有效。请妥善保管，如非本人操作，请忽略。【永盟投资】';//utf8

        $url = "http://api.jisuapi.com/sms/send?appkey=$appkey&mobile=$mobile&content=$content";
        $result = $this->curlOpen($url);
        $jsonarr = json_decode($result, true);
        //exit(var_dump($jsonarr));
        if($jsonarr['status'] != 0)
        {
            return $jsonarr['msg'];
            exit();
        }
        $result = $jsonarr['result'];
        Cache::add('sms',$rand,5);
        return $result['count'].' '.$result['accountid'].'<br>';
    }

    // 极速数据短信类Curl方法
    /**
     * 使用：
     * echo curlOpen('http://www.baidu.com');
     *
     * POST数据
     * $post = array('aa'=>'ddd','ee'=>'d')
     * 或
     * $post = 'aa=ddd&ee=d';
     * echo curlOpen('http://www.baidu.com',array('post'=>$post));
     * @param string $url
     * @param array $config
     */
    protected function curlOpen($url, $config = array())
    {
        $arr = array('post' => false,'referer' => $url,'cookie' => '', 'useragent' => 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; customie8)', 'timeout' => 20, 'return' => true, 'proxy' => '', 'userpwd' => '', 'nobody' => false,'header'=>array(),'gzip'=>true,'ssl'=>false,'isupfile'=>false);
        $arr = array_merge($arr, $config);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $arr['return']);
        curl_setopt($ch, CURLOPT_NOBODY, $arr['nobody']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $arr['useragent']);
        curl_setopt($ch, CURLOPT_REFERER, $arr['referer']);
        curl_setopt($ch, CURLOPT_TIMEOUT, $arr['timeout']);
        //curl_setopt($ch, CURLOPT_HEADER, true);//获取header
        if($arr['gzip']) curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        if($arr['ssl'])
        {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        if(!empty($arr['cookie']))
        {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $arr['cookie']);
            curl_setopt($ch, CURLOPT_COOKIEFILE, $arr['cookie']);
        }

        if(!empty($arr['proxy']))
        {
            //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            curl_setopt ($ch, CURLOPT_PROXY, $arr['proxy']);
            if(!empty($arr['userpwd']))
            {
                curl_setopt($ch,CURLOPT_PROXYUSERPWD,$arr['userpwd']);
            }
        }

        //ip比较特殊，用键值表示
        if(!empty($arr['header']['ip']))
        {
            array_push($arr['header'],'X-FORWARDED-FOR:'.$arr['header']['ip'],'CLIENT-IP:'.$arr['header']['ip']);
            unset($arr['header']['ip']);
        }
        $arr['header'] = array_filter($arr['header']);

        if(!empty($arr['header']))
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $arr['header']);
        }

        if ($arr['post'] != false)
        {
            curl_setopt($ch, CURLOPT_POST, true);
            if(is_array($arr['post']) && $arr['isupfile'] === false)
            {
                $post = http_build_query($arr['post']);
            }
            else
            {
                $post = $arr['post'];
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $result = curl_exec($ch);
        //var_dump(curl_getinfo($ch));
        curl_close($ch);

        return $result;
    }

}