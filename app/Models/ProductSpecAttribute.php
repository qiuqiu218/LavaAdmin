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

    /**
     * @param $value
     * @return array
     */
    public function getValuesAttribute($value)
    {
        return $value ? json_decode($value) : [];
    }

    /**
     * 根据分类id获取规格属性
     * @param $product_classify_id
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getSpecAttribute($product_classify_id)
    {
        $data = null;

        if ($product_classify_id) {
            $item = ProductClassify::query()->find($product_classify_id);
            $root = $item->getRoot();
            $data = $this->query()->where('product_classify_id', $root->id)->get();
        }

        return $data ? $data : [];
    }
}
