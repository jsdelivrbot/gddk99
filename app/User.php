<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const USER_PUBLIC = 0; // 默认
    const IS_USER = 1;  // 登录状态
    const FAIL_TIME = 60;  // 失效时间,60秒

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'user_mobile',
        'password',
        'is_admin',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function setPasswordAttribute($password){
        $this->attributes['password'] = \Hash::make($password);
    }
}
