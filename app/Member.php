<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    const SEX_SECRET = 0;
    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

    public $primaryKey = 'member_id';


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

}
