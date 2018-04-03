<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('table_id')->comment('表id');
            $table->string('name', 20)->comment('字段标识');
            $table->string('display_name', 30)->comment('字段名称');
            $table->string('type', 20)->comment('字段类型')->default('string');
            $table->string('type_length', 20)->comment('字段长度')->nullable();
            $table->string('element', 20)->comment('显示元素');
            $table->string('default_value', 255)->comment('默认值')->nullable();
            $table->json('option')->comment('选项(下拉框，复选框，单选框)')->nullable();
            $table->unsignedTinyInteger('belong')->comment('1主表,2副表')->default(1);
            $table->unsignedTinyInteger('is_show')->comment('是否显示')->default(0);
            $table->unsignedTinyInteger('is_import')->comment('是否可输入')->default(1);
            $table->unsignedTinyInteger('is_system')->comment('是否系统字段')->default(0);
            $table->unsignedTinyInteger('sort')->comment('排序')->nullable();
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
        Schema::dropIfExists('fields');
    }
}
