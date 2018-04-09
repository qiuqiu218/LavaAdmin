<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'product_classify_id',
        'title',
        'cover_img',
        'original_price',
        'current_price'
    ];

    /**
     * 关联产品详情表
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product_detail_table()
    {
        return $this->hasOne('App\Models\ProductDetail');
    }

    /**
     * 关联产品规格表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_spec_item_table()
    {
        return $this->hasMany('App\Models\ProductSpecItem');
    }

    /**
     * 关联评论表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_comment_table()
    {
        return $this->hasMany('App\Models\ProductComment');
    }
}
