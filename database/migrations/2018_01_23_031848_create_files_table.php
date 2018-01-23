<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('上传的会员id');
            $table->string('model', 20)->comment('模型');
            $table->unsignedInteger('info_id')->comment('信息id')->nullable();
            $table->string('name', 30)->comment('文件名称');
            $table->string('path', 120)->comment('文件路径');
            $table->string('mime', 20)->comment('Mime类型');
            $table->unsignedInteger('size')->comment('文件大小');
            $table->unsignedTinyInteger('type')->comment('文件类型(1图片2媒体3附件)');
            $table->unsignedTinyInteger('is_admin')->comment('是否管理员上传')->default(0);
            // 添加信息时会附带相同的标记，用于更新该数据的info_id
            $table->unsignedInteger('mark')->comment('标记');

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
        Schema::dropIfExists('files');
    }
}
