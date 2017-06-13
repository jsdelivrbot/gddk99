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

    public function Sex(){
        $member_sex =[
            ['sex_id'=>0,'sex_name'=>'保密','sex_number'=>self::SEX_SECRET ],
            ['sex_id'=>1,'sex_name'=>'男','sex_number'=>self::SEX_MAN ],
            ['sex_id'=>2,'sex_name'=>'女','sex_number'=>self::SEX_WOMAN ],
        ];
        return $member_sex;
    }
}
