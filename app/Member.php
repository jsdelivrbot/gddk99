<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    const SEX_SECRET = 0;
    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

    const MEMBER_PUBLIC = 0; // 默认
    const IS_MEMBER = 1;  // 登录状态
    const FAIL_TIME = 60;  // 失效时间,60秒

    const MEMBER_TYPE_ONE = 1; // 会员类型 (普通会员 默认 1)
    const MEMBER_TYPE_TWO = 2; // 会员类型 (VIP会员)
    const MEMBER_TYPE_THREE = 3; // 合伙人类型 (合伙人会员)

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
        'member_bank_card',
        'member_card_type',
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

    public function cardType(){
        return   $cardType =[
            ['id'=>1, 'name'=>'中国工商银行'],
            ['id'=>2, 'name'=>'中国银行'],
            ['id'=>3, 'name'=>'中国农业银行'],
            ['id'=>4, 'name'=>'汇丰银行'],
            ['id'=>5, 'name'=>'东莞农村商业银行'],
            ['id'=>6, 'name'=>'支付宝'],
        ];
    }

    public function memberType($memberType){
        switch ($memberType)
        {
            case '1':
                return "普通用户";
                break;
            case '2':
                return "VIP用户";
                break;
            case '3':
                return '合伙人用户';
                break;
            case '4':
                return '加盟商用户';
                break;
            case '5':
                return '运营商用户';
                break;
            case '6':
                return '总部用户';
                break;
            default:
                return "普通用户";
        }
    }

}
