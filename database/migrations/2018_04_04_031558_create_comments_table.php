<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('table_id')->comment('表id');
            $table->unsignedInteger('info_id')->comment('信息id');
            $table->unsignedInteger('user_id')->comment('会员id');
            $table->string('content')->comment('评论内容')->defualt('');
            $table->json('images')->comment('评论图片')->nullable();
            $table->unsignedTinyInteger('grade')->comment('评分')->default(0);
            $table->unsignedTinyInteger('anonymity')->comment('是否匿名')->default(0);

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
        Schema::dropIfExists('comments');
    }
}
