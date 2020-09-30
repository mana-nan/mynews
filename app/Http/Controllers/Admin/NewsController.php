<?php
//Adminはブログを投稿するユーザーの設定です
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;

class NewsController extends Controller
{
    //
    
    
    public function add()
    {
        return view ('admin.news.create');
    }
    
    public function create(Request $request)
    {
        //Validationを行う
        $this->validate($request, News::$rules);
        
        $news = new News;
        $form = $request->all();
        
        //フォームから画像が送信されたら保存し、$news->image_pathに画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $news->image_path = basename($path);
        } else {
            $news->image_path = null;
        }
        
        //フォームから送信されてきた_tokenを削除
        unset($form['_token']);
        unset($form['image']);
        
        $news->fill($form);
        $news->save();
        
        //admin/news/createにリダイレクトする
        return redirect('admin/news/create');
    }
    
    
    
}

