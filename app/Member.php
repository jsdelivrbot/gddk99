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

    const MEMBER_STATUS_ONE = 10; // 会员状态     默认
    const MEMBER_STATUS_TWO = 20; // 会员状态     需要初审核状态
    const MEMBER_STATUS_THREE = 30; // 会员状态   初审完成状态
    const MEMBER_STATUS_FOUR = 40; // 会员状态    完成审核状态

    const MEMBER_CHECK_ONE = 0; // 会员审核 默认
    const MEMBER_CHECK_TWO = 1; // 会员初审核
    const MEMBER_CHECK_THREE = 2; // 会员审核完成

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
        'member_check',
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
            ['id'=>1, 'name'=>'中国银行'],
            ['id'=>2, 'name'=>'中国工商银行'],
            ['id'=>3, 'name'=>'中国农业银行'],
            ['id'=>4, 'name'=>'汇丰银行'],
            ['id'=>5, 'name'=>'东莞农村商业银行'],
            ['id'=>6, 'name'=>'支付宝'],

            ['id'=>7, 'name'=>'中国建设银行'],
            ['id'=>8, 'name'=>'中国邮政银行'],
            ['id'=>9, 'name'=>'中国交通银行'],
            ['id'=>10, 'name'=>'中国人民银行'],
            ['id'=>11, 'name'=>'中国招商银行'],
            ['id'=>12, 'name'=>'中国兴业银行'],
            ['id'=>13, 'name'=>'中国中信银行'],
            ['id'=>14, 'name'=>'中国光大银行'],
            ['id'=>15, 'name'=>'中国民生银行'],
            ['id'=>16, 'name'=>'中国广发银行'],
            ['id'=>17, 'name'=>'中国华夏银行'],
            ['id'=>18, 'name'=>'中国浦发银行'],
            ['id'=>19, 'name'=>'深圳发展银行'],

            ['id'=>20, 'name'=>'长沙银行'],
            ['id'=>21, 'name'=>'北京银行'],
            ['id'=>22, 'name'=>'哈尔滨银行'],
            ['id'=>23, 'name'=>'吉林银行'],
            ['id'=>24, 'name'=>'沈阳盛京银行'],
            ['id'=>25, 'name'=>'天津银行'],
            ['id'=>26, 'name'=>'河北银行'],
            ['id'=>27, 'name'=>'山西晋城银行'],
            ['id'=>28, 'name'=>'内蒙古银行'],
            ['id'=>29, 'name'=>'兰州银行'],
            ['id'=>30, 'name'=>'青海银行'],
            ['id'=>31, 'name'=>'郑州银行'],
            ['id'=>32, 'name'=>'西安银行'],
            ['id'=>33, 'name'=>'长安银行'],
            ['id'=>34, 'name'=>'苏州银行'],
            ['id'=>35, 'name'=>'上海银行'],
            ['id'=>36, 'name'=>'微商银行'],
            ['id'=>37, 'name'=>'杭州银行'],
            ['id'=>38, 'name'=>'南昌商业银行'],
            ['id'=>39, 'name'=>'福建海峡银行'],
            ['id'=>40, 'name'=>'贵州银行'],
            ['id'=>41, 'name'=>'广西北部湾银行'],
            ['id'=>42, 'name'=>'成都银行'],
            ['id'=>43, 'name'=>'台湾银行'],
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
