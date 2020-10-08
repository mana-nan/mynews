<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;

use App\ProHistory;

use Carbon\Carbon;

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
    
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        if($cond_name != ''){
            $posts = Profile::where('name', $cond_name)->get();
        } else { 
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }
    
    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        //validationをかける
        $this->validate($request, Profile::$rules);
        //News Modelからデータ取得
        $profile = Profile::find($request->id);
        //送信されてきたフォームデータを削除
        $profile_form = $request->all();
        
        unset($profile_form['_token']);
        
        //該当するデータを上書き保存
        $profile->fill($profile_form)->save();
        
        //ProHistory Modelに編集履歴追加
        $prohistory = new ProHistory;
        $prohistory->profile_id = $profile->id;
        $prohistory->edited_at = Carbon::now();
        $prohistory->save();
        
        //これ違うっぽい、何でだ
        //return redirect('admin/profile/edit');
        return redirect('admin/profile');
    }
}
