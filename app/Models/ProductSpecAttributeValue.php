<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpecAttributeValue extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'product_spec_attribute_id',
        'title'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'product_spec_attribute_id',
        'created_at',
        'updated_at',
        'notes'
    ];
}
