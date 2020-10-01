<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = array('id');
    protected $fillable = array('title');
    //
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
}