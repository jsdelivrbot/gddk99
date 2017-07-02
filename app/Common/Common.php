<?php
namespace App\Common;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Cache;
use Request;

class Common
{

    public $upload ="uploads"; // 定义上传目录

    protected $pic_path = 'build/uploads/'; //读取图片路径


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

    // 生成海报方法：png  背景图片，二维码图片，合成图片路径，左右移位，上下移位
    public function Poster($backgrond,$qrcode,$path,$dst_x='210',$dst_y='440'){
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
        imagecopymerge($image_3,$image_2, $dst_x,$dst_y,0,0,imagesx($image_2),imagesy($image_2), 100);
        imagepng($image_3,$path);
        imagedestroy($image_3);
        imagedestroy($image_2);
    }

    // 极速数据短信类方法
    public function Send_sms($phone){
        $appkey = env('SMS_APP_KEY');//你的appkey
        $mobile = $phone;//手机号 超过1024请用POST
        $rand=rand(1000,9999);
        $content = '尊敬的用户您好，您的短信验证码为'.$rand.'，5分钟内有效。请妥善保管，如非本人操作，请忽略。【永盟投资】';//utf8
        $url = "http://api.jisuapi.com/sms/send?appkey=$appkey&mobile=$mobile&content=$content";
        $result = $this->curlOpen($url);
        $jsonarr = json_decode($result, true);
        if($jsonarr['status'] != 0)
        {
            return $jsonarr['msg'];
            exit();
        }
        $result = $jsonarr['result'];
        Cache::add('sms',$rand,5);
        return $result['count'].' '.$result['accountid'].'<br>';
    }

    // 极速数据短信CURL方法
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
        curl_close($ch);
        return $result;
    }

    // 公用Model接收判断方法函数
    public function If_com($val,$keyVal=0){
        $memberUser = (new Common())->if_isset($val,$keyVal);
        if ($memberUser==$keyVal){ Cache::pull('mobile_user'); Cache::pull('scope'); }
        return $memberUser;
    }

    // 公用Model是否存在值，方法函数
    public function If_val($key,$val=null){
        // 如果$key 是空的输出 $val , 如果$key 不是空的输出$key
       return  empty($key) ? $val: $key;
    }

    // 生成二维码方法函数
    public function QrCode($Id,$path,$HttpUrl){
        // $Id = 1;
        // $path = 'uploads/qrcode';
        // $HttpUrl = 'api/member-user-invite?member_parent_id=';
        $qrcode_pictrue = public_path($path.$Id.'.png');
        $url='http://'.Request::getHttpHost().'/'.$HttpUrl.$Id;
        $qrcode_url = 'http://'.Request::getHttpHost().'/'.$path.$Id.'.png';
        if(!file_exists($qrcode_pictrue)){
            QrCode::encoding('UTF-8')->format('png')->size(200)->margin(1)->generate($url,public_path($path.$Id.'.png'));
        }
        return ['qrcode_url'=>$qrcode_url,'url'=>$url];
    }

    // 判断值是否为空函数
    public function if_empty($key,$val=0){
        return empty($key) ? $val : $key;
    }

    // 检测是否有值函数
    public function if_isset($key,$val=0){
        return isset($key) ? $key : $val;
    }

    // 定义读取图片路径  url('build/uploads/'.$member_id.'.png')
    public function picUrlPath($val){
        if (!empty($val)){
            return url($this->pic_path.$val);
        }else{
            return null;
        }
    }

    //读取公用目录图片路径  public_path('build/uploads/sc'.$member_id.'.png')
    public function PublicPath($name,$val){
        return public_path($this->pic_path.$name.$val.'.png');
    }

    // 检测本地图片路径是否存在，同时匹配数据库图片是否相同，如果相同删除---限制单张图片上传方法
    public function DataPic($post,$data){
        //检测post数据是否有值 接收POST图片数据路径
        if (isset($post)){
            // 判断数据库DATA读取的数据是否为空，取反
            if (!empty($data)){
                // 读取目录图片
                $images = public_path($this->pic_path.$data);
                // 检测目录图片是否存在
                if (file_exists($images)){
                    unlink($images);
                }
            }
        }
        return true;
    }

}