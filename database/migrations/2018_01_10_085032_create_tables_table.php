<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->comment('表标识');
            $table->string('display_name', 30)->comment('表名');
            $table->unsignedTinyInteger('type')->comment('类型(0系统表,1普通表)');
            $table->unsignedTinyInteger('is_sub_table')->comment('是否有副表');
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
        Schema::dropIfExists('tables');
    }
}
