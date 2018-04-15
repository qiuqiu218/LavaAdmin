<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRefund extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_order_detail_id',
        'total_fee',
        'total_quantity',
        'status',
        'content',
        'images'
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
     * @param $value
     * @return mixed
     */
    public function getStatusAttribute($value)
    {
        return config('enum.ProductRefund.status')[$value] ?? '未知状态';
    }

    /**
     * @param $value
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = array_search($value, config('enum.ProductRefund.status')) ?? 1;
    }
}
