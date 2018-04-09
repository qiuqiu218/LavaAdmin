<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpecItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'product_classify_id',
        'product_id',
        'price',
        'store_count',
        'spec_collect'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'spec_collect' => 'array'
    ];
}
