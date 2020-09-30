<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guard = array('id');
    //
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
}
