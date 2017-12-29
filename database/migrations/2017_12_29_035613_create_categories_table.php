<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('categories', function(Blueprint $table) {
      // These columns are needed for Baum's Nested Set implementation to work.
      // Column names may be changed, but they *must* all exist and be modified
      // in the model.
      // Take a look at the model scaffold comments for details.
      // We add indexes on parent_id, lft, rgt columns by default.
        $table->increments('id');
        $table->integer('parent_id')->comment('父级id')->nullable();
        $table->integer('lft')->comment('左边界')->nullable();
        $table->integer('rgt')->comment('右边界')->nullable();
        $table->integer('depth')->comment('深度')->nullable();

        $table->string('title', 60)->comment('分类名称')->default('');
        $table->string('description', 120)->comment('分类描述')->default('');
        $table->unsignedInteger('info_total')->comment('信息总数')->default(0);
        $table->unsignedMediumInteger('sort')->comment('排序')->default(0);
        $table->timestamps();

        $table->index('parent_id');
        $table->index('lft');
        $table->index('rgt');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('categories');
  }

}
