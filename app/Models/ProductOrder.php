<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'out_trade_no',
        'total_fee',
        'express_fee',
        'quantity',
        'status',
        'products'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'products' => 'array'
    ];
}
