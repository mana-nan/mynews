<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = array('id');
    protected $fillable = array('title', 'body');
    
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
    
    public function histories()
    {
        //HasManyで複数のデータ取得
        return $this->hasMany('App\History');
    }
}
