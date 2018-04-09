<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpecAttribute extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'product_classify_id',
        'name',
        'title',
        'values'
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
        'values' => 'array'
    ];
}
