<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    const CON_TYPE_ONE = 1;
    const CON_TYPE_TWO = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'con_name',
        'con_pic',
        'con_pic_all',
        'con_person',
        'con_time',
        'con_pf',
        'con_tel',
        'con_wx_pic',
        'con_content',
        'con_content_area',
        'con_content_range',
        'con_add',
        'con_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

}
