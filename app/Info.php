<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    const SEX_SECRET = 0;
    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

    public $primaryKey = 'info_id';

    protected $fillable = [
      'info_name',
      'info_sex',
      'info_mobile',
      'info_quota',
      'info_unit',
      'info_status',
      'info_remark',
      'member_id',  // 提示目前会员ID已经是info的类型，不在在是会员ID，
      'info_invite', // 邀请可以讲是会员ID
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

    public function getInfoSexTextAttribute()
    {
        if ($this->info_sex==""){
            return '无';
        }else{
            return empty($this->info_sex) ? self::sexLabelList()[$this->info_sex] : self::sexLabelList()[$this->info_sex];
        }
    }

    public function InfoStatus()
    {
        $info_status =[
            ['id'=>0,'name'=>'申办中','number'=>'0'],
            ['id'=>1,'name'=>'已结办','number'=>'1'],
        ];
        return $info_status;
    }

}
