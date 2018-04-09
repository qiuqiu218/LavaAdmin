<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'product_id',
        'name',
        'path',
        'mime',
        'size'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
