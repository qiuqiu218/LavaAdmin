<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
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
}
