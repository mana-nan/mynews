<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title'); //ニュースのタイトルを保存するカラム
            $table->string('body'); // 本文を保存するカラム
            $table->string('image_path')->nullable(); //画像のパスを保存するカラム
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     
    //マイグレーションの取り消し
    public function down()
    {
        //newsテーブルが存在すれば削除
        Schema::dropIfExists('news');
    }
}
