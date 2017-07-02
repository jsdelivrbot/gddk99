<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    const SEX_SECRET = 0;
    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

    const MEMBER_PUBLIC = 0; // 默认
    const IS_MEMBER = 1;  // 登录状态
    const FAIL_TIME = 60;  // 失效时间,60秒

    public $primaryKey = 'member_id';


    protected $fillable = [
        'member_id',
        'member_name',
        'member_avatar',
        'password',
        'member_surname',
        'member_content',
        'member_age',
        'member_sex',
        'member_card',
        'member_tel',
        'member_mobile',
        'member_add',
        'member_province',
        'member_city',
        'member_type',
        'member_status',
        'member_parent_id',
        'is_member',
        'wechat_openid',
        'wechat_nickname',
        'wechat_headimgurl',
    ];

    protected $hidden = [];

    public static function sexLabelList()
    {
        return [
            self::SEX_SECRET => '保密',
            self::SEX_MAN => '男',
            self::SEX_WOMAN => '女'
        ];
    }

    public function getMemberSexTextAttribute()
    {
        return empty($this->member_sex) ? self::sexLabelList()[$this->member_sex] : self::sexLabelList()[$this->member_sex];
    }

    public function Sex(){
        $member_sex =[
            ['sex_id'=>0,'sex_name'=>'保密','sex_number'=>self::SEX_SECRET ],
            ['sex_id'=>1,'sex_name'=>'男','sex_number'=>self::SEX_MAN ],
            ['sex_id'=>2,'sex_name'=>'女','sex_number'=>self::SEX_WOMAN ],
        ];
        return $member_sex;
    }

    public function setPasswordAttribute($password){
        $this->attributes['password'] = \Hash::make($password);
    }

}
