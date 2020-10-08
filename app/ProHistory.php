<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProHistory extends Model
{
    protected $guarded = array('id');
    protected $table = 'prohistories';
    
    public static $rules = array(
        'profile_id' => 'required',
        'edited_at' => 'required',
    );
}
