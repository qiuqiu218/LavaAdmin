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
            $table->increments('id');
            $table->string('title', 60)->comment('标题');
            $table->unsignedInteger('read')->comment('阅读数')->default(0);
            $table->string('cover_img', 120)->comment('封面图')->nullable();
            $table->timestamps();
        });
        Schema::create('news_subs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('news_id');
            $table->text('detail')->comment('详情')->defualt('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
        Schema::dropIfExists('news_subs');
    }
}
