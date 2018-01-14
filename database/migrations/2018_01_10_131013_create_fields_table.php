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
            $table->string('type', 20)->comment('字段类型');
            $table->string('default_value', 30)->comment('默认值')->nullable();
            $table->unsignedTinyInteger('belong')->comment('1主表,2副表')->default(1);
            $table->unsignedTinyInteger('is_show')->comment('是否显示');
            $table->unsignedTinyInteger('is_import')->comment('是否可输入');
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
