<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'product_order_detail_id',
        'product_order_id',
        'product_id',
        'user_id',
        'content',
        'images',
        'grade',
        'is_anonymity'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'images' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product_order_detail()
    {
        return $this->belongsTo('App\Models\ProductOrderDetail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
