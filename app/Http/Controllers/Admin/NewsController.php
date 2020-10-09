<?php
//Adminはブログを投稿するユーザーの設定です
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;

use App\History;

use Carbon\Carbon;

class NewsController extends Controller
{
    public function add()
    {
        //views/admin/news/create.blade.phpの内容表示
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
        
        // データベースに保存する
        $news->fill($form);
        $news->save();
        
        //admin/news/create.blade.phpにリダイレクトする
        return redirect('admin/news/create');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != ''){
            //Modelに対しWhereメソッド指定して検索
            //検索されたら検索結果（ニューステーブルの中のタイトルカラム）取得
            $posts = News::where('title', $cond_title)->get();
        } else {
            //それ以外は全てのニュース(newsテーブルのレコード全て)を取得
            $posts = News::all();
        }
        return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request)
    {
        //News Modelからデータを取得する
        $news = News::find($request->id);
        if (empty($news)) {
            abort(404);
        }
        return view('admin.news.edit', ['news_form' => $news]);
    }
    
    public function update(Request $request)
    {
        //validationかける
        $this->validate($request, News::$rules);
        //News Model からデータを取得
        $news = News::find($request->id);
        //送信されてきたフォームデータを格納
        $news_form = $request->all();
        
       /*修正前のコード
       if (isset($news_form['image'])){
            $path = $request->file('image')->store('public/image');
            $news->image_path = basename($path);
            unset($news_form['image']);
        } elseif (isset($request->remove)) {
            $news->image_path = null;
            unset($news_form['remove']);
        }*/
        
        //修正後のコード
        if ($request->remove == 'true') {
            $news_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $news_form['image_path'] = basename($path);
            $news->image_path = $news_form['image_path'];
        } else {
            $news_form['image_path'] = $news->image_path;
        }
        
        unset($news_form['_token']);
        
        //該当するデータを上書きして保存
        $news->fill($news_form)->save();
        
        //History Modelに編集履歴を追加
        $history = new History;
        $history->news_id = $news->id;
        $history->edited_at = Carbon::now();
        $history->save();
        
        return redirect('admin/news');
    }
    
    public function delete (Request $request)
    {
        //該当するニュースモデルを取得
        $news = News::find($request->id);
        //削除
        $news->delete();
        return redirect('admin/news/');
    }
}

