<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    const SEX_SECRET = 0;
    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

    public $primaryKey = 'info_id';

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

}
