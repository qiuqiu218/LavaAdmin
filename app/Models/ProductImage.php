<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    /**
     * @param $value
     * @return string
     */
    public function getPathAttribute($value)
    {
        return Storage::disk('images')->url($value);
    }
}
