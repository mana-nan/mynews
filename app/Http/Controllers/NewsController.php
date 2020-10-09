<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        //記事の投稿日時を新しい順で並べ、変数postsに代入
        $posts = News::all()->sortByDesc('uploaded_at');
        
        // postsがゼロじゃなかったら
        if (count($posts) > 0) {
            //最新記事とそれ以外で分ける
            //最新記事を変数headlineに代入
            $headline = $posts->shift();
        } else {
            $headline = null;
        }
        return view('news.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
