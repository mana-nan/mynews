<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //'profiles'というテーブルを作成
        Schema::create('profiles', function (Blueprint $table) {
            //テーブルは、以下のカラムを持つ
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('gender');
            $table->string('hobby');
            $table->string('introduction');
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
        //'profiles'テーブルが存在したら、削除する
        Schema::dropIfExists('profiles');
    }
}
