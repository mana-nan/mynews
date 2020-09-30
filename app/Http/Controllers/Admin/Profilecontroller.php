<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;

class Profilecontroller extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        //Validationを行う
        $this->validate($request, Profile::$rules);
        
        //変数を定義
        $profile = new Profile;
        $form = $request->all();
        
        //フォームから送信されてきた_tokenを削除
        unset($form['_token']);
    
        $profile->fill($form);
        $profile->save();
        return redirect('admin/profile/create');
    }
    
    public function edit()
    {
        return view('admin.profile.edit');
    }
    
    public function update()
    {
        return redirect('admin/profile/edit');
    }
}
?>