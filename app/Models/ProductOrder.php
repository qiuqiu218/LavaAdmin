<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'out_trade_no',
        'total_fee',
        'express_fee',
        'total_quantity',
        'status'
    ];

    /**
     * @param $value
     * @return mixed
     */
    public function getStatusAttribute($value)
    {
        return config('enum.ProductOrder.status')[$value] ?? '未知状态';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_order_detail_table()
    {
        return $this->hasMany('App\Models\ProductOrderDetail');
    }
}
