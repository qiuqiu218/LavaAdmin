<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOrderDetail extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'product_order_id',
        'product_id',
        'title',
        'cover_img',
        'original_price',
        'current_price',
        'quantity',
        'spec'
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
        'spec' => 'array'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getSpecAttribute($value)
    {
        $value = collect(json_decode($value))->map(function ($item) {
            return $item->text.'：'.$item->value;
        })->implode('、');
        return $value;
    }
}
