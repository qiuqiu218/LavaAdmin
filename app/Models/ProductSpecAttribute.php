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
        'title'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_spec_attribute_value_table()
    {
        return $this->hasMany('App\Models\ProductSpecAttributeValue');
    }

    /**
     * 根据分类id获取规格属性
     * @param $product_classify_id
     * @param $spec
     * @return array|\Illuminate\Database\Eloquent\Collection|null|static[]
     */
    public function getSpecAttribute($product_classify_id, $spec = [])
    {
        $data = null;

        if ($product_classify_id) {
            $item = ProductClassify::query()->find($product_classify_id);
            $root = $item->getRoot();
            $data = $this->query()->with('product_spec_attribute_value_table')->where('product_classify_id', $root->id)->get();
            $data = $data->map(function ($item) use ($spec) {
                $first = collect($spec)->firstWhere('name', $item->name);

                $item->product_spec_attribute_value_table->map(function ($item) use ($first) {

                    $item->active = collect($first['collect'])->contains($item->title);
                    return $item;
                });
                return $item;
            });
        }

        return $data ? $data : [];
    }
}
