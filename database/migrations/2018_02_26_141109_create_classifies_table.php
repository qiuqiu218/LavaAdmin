<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->comment('父级id')->nullable();
            $table->integer('lft')->comment('左边界')->nullable();
            $table->integer('rgt')->comment('右边界')->nullable();
            $table->integer('depth')->comment('深度')->nullable();
            $table->string('title', 30)->comment('菜单标题');
            $table->unsignedSmallInteger('table_id')->comment('所属表id');
            $table->unsignedSmallInteger('sort')->comment('排序')->nullable();
            $table->timestamps();

            $table->index('parent_id');
            $table->index('table_id');
            $table->index('lft');
            $table->index('rgt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifies');
    }
}
