<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'product_id',
        'description',
        'images',
        'spec'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'product_id',
        'id'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'images' => 'array',
        'spec' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getImagesAttribute($value)
    {
        $value = $value ? $value : '[]';
        return ProductImage::query()->whereIn('id', json_decode($value))->get();
    }
}
