<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{

    public $primaryKey = 'app_id';

    protected $fillable = [
        'app_name',
        'app_nature',
        'app_username',
        'app_number',
        'app_pic_z',
        'app_pic_b',
        'app_mobile',
        'app_status',
        'app_type',
        'member_id',
    ];

    protected $hidden = [];


}
