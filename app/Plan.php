<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'plan_title',
        'plan_title_a',
        'plan_title_b',
        'plan_title_c',
        'plan_title_d',
        'plan_title_e',
        'plan_title_f',
        'plan_title_g',
        'plan_title_h',
        'plan_con_a',
        'plan_con_b',
        'plan_con_c',
        'plan_type_a',
        'plan_type_b',
        'plan_type_c'
    ];

    protected $hidden = [];


    public function planType(){
      return   $planType =[
                    ['id'=>1, 'name'=>'信用贷'],
                    ['id'=>2, 'name'=>'企业贷'],
                    ['id'=>3, 'name'=>'工资贷'],
                    ['id'=>4, 'name'=>'车贷'],
                    ['id'=>5, 'name'=>'房贷'],
                ];
    }

}
