<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->comment('产品id');
            $table->unsignedInteger('user_id')->comment('会员id');
            $table->string('out_trade_no', 14)->comment('订单号');
            $table->decimal('total_fee', 8, 2)->comment('总金额')->default('0.00');
            $table->decimal('express_fee', 7, 2)->comment('快递费')->default('0.00');
            $table->unsignedSmallInteger('quantity')->comment('商品总数量')->default(0);
            $table->unsignedTinyInteger('status')->comment('订单状态')->default(0);
            $table->json('goods')->comment('商品列表')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
