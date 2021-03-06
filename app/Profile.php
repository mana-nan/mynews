<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //$guardedに指定したカラムのみ、create()やfill()、update()で値が代入されない
    protected $guarded = array('id');
    protected $fillable = array('name', 'gender', 'hobby', 'introduction');
    
    //validation
    public static $rules = array(
        'name'=>'required',
        'gender'=>'required',
        'hobby'=>'required',
        'introduction'=>'required',
    );
    
    public function prohistories()
    {
        //HasManyでProHIstoryモデルから複数データ取得
        return $this->hasMany('App\ProHistory');
    }
}
