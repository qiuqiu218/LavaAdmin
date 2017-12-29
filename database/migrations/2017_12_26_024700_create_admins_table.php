<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 30)->comment('用户名');
            $table->string('nickname', 30)->comment('昵称')->nullable();
            $table->string('email', 30)->comment('邮箱')->nullable();
            $table->string('phone', 15)->comment('手机号')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->unique('username');
            $table->unique('phone');
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
