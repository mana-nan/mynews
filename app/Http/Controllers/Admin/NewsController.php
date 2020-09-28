<?php
//Adminはブログを投稿するユーザーの設定です
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    //
    public function add()
    {
        return view ('admin.news.create');
    }
    
    public function create(Request $request)
    {
        //admin/news/createにリダイレクトする
        return redirect('admin/news/create');
    }
}

