<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //$guardedに指定したカラムのみ、create()やfill()、update()で値が代入されない
    protected $guard = array('id');
    
    //validation
    public static $rules = array(
        'name'=>'required',
        'gender'=>'required',
        'hobby'=>'required',
        'introduction'=>'required',
    );
    
}
