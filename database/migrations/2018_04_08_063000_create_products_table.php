<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 产品表
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_classify_id')->comment('关联分类id')->default(0);
            $table->unsignedInteger('brand_id')->comment('关联品牌id')->default(0);
            $table->string('title', 120)->comment('产品标题');
            $table->string('cover_img', 255)->comment('封面图')->nullable();
            $table->decimal('original_price', 8, 2)->comment('原价')->nullable();
            $table->decimal('current_price', 8, 2)->comment('现价')->nullable();
            $table->unsignedInteger('read')->comment('查看数')->default(0);
            $table->timestamps();

            $table->index('product_classify_id');
        });
        /**
         * 产品详情表
         * spec = [{'name' => 'color', 'title' => '颜色', 'collect' => ['黑色', '白色']}]
         */
        Schema::create('product_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->comment('关联产品id');
            $table->text('description')->comment('商品描述')->nullable();
            $table->json('images')->comment('图集')->nullable();
            $table->json('spec')->comment('规格')->nullable();
            $table->timestamps();

            $table->index('product_id');
        });

        // 品牌表
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 120)->comment('品牌标题');
            $table->string('logo', 255)->comment('LOGO')->default('');
            $table->string('cover_img', 255)->comment('封面图')->defualt('');
            $table->text('description')->comment('品牌描述')->defualt('');
            $table->unsignedMediumInteger('product_count')->comment('产品数量')->default(0);
            $table->unsignedMediumInteger('fans_count')->comment('粉丝数')->default(0);

            $table->timestamps();
        });
        // 产品图片表
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->comment('关联产品id')->default(0);
            $table->string('name', 30)->comment('文件名称');
            $table->string('path', 120)->comment('文件路径');
            $table->string('mime', 20)->comment('Mime类型');
            $table->unsignedInteger('size')->comment('文件大小');
            $table->timestamps();

            $table->index('product_id');
        });
        // 产品分类表(整表缓存)
        Schema::create('product_classifies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->comment('父级id')->nullable();
            $table->integer('lft')->comment('左边界')->nullable();
            $table->integer('rgt')->comment('右边界')->nullable();
            $table->integer('depth')->comment('深度')->nullable();
            $table->string('title', 30)->comment('分类名称');
            $table->unsignedMediumInteger('product_count')->comment('产品数量')->default(0);
            $table->unsignedSmallInteger('sort')->comment('排序')->nullable();
            $table->timestamps();

            $table->index('parent_id');
            $table->index('lft');
            $table->index('rgt');
        });
        /**
         * 规格属性表(整表缓存)
         * product_classify_id为顶级分类id
         */
        Schema::create('product_spec_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_classify_id')->comment('关联分类id')->default(0);
            $table->string('name', 30)->comment('标识');
            $table->string('title', 30)->comment('属性名称');
            $table->timestamps();
        });

        /**
         * 规格属性值表(整表缓存)
         * product_classify_id为顶级分类id
         */
        Schema::create('product_spec_attribute_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_spec_attribute_id')->comment('关联属性id');
            $table->string('title', 30)->comment('值名称');
            $table->string('notes', 60)->comment('备注(暂时不用)')->nullable();
            $table->timestamps();
        });

        /**
         * 产品规格表
         * product_classify_id字段性质与products表一致(最终极分类id)
         * spec_collect = {color: '黑色', size: 'XL'}
         */
        Schema::create('product_spec_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_classify_id')->comment('关联分类id')->default(0);
            $table->unsignedInteger('product_id')->comment('关联产品id')->default(0);
            $table->decimal('price', 8, 2)->comment('价格')->nullable();
            $table->string('title', 120)->comment('规格名称');
            $table->unsignedMediumInteger('store_count')->comment('库存数量')->default(0);
            $table->json('spec_collect')->comment('规格集合')->nullable();
            $table->timestamps();

            $table->index('product_classify_id');
            $table->index('product_id');
        });
        // 订单表
        Schema::create('product_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('会员id');
            $table->unsignedInteger('product_id')->comment('产品id');
            $table->string('out_trade_no', 14)->comment('订单号');
            $table->decimal('total_fee', 8, 2)->comment('总金额')->default('0.00');
            $table->decimal('express_fee', 7, 2)->comment('快递费')->default('0.00');
            $table->unsignedSmallInteger('quantity')->comment('商品总数量')->default(0);
            $table->unsignedTinyInteger('status')->comment('订单状态')->default(0);
            $table->json('products')->comment('商品列表')->nullable();

            $table->timestamps();

            $table->index('user_id');
            $table->index('out_trade_no');
        });
        // 评论表
        Schema::create('product_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_order_id')->comment('订单id');
            $table->unsignedInteger('product_id')->comment('产品id');
            $table->unsignedInteger('user_id')->comment('会员id');
            $table->string('content')->comment('评论内容')->defualt('');
            $table->json('images')->comment('评论图片')->nullable();
            $table->unsignedTinyInteger('grade')->comment('评分')->default(0);
            $table->unsignedTinyInteger('is_anonymity')->comment('是否匿名')->default(0);
            $table->timestamps();

            $table->index('product_id');
            $table->index('product_order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_details');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_classifies');
        Schema::dropIfExists('product_spec_attributes');
        Schema::dropIfExists('product_spec_attribute_values');
        Schema::dropIfExists('product_spec_items');
        Schema::dropIfExists('product_orders');
        Schema::dropIfExists('product_comments');
    }
}
