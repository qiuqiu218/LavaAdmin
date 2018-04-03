<?php

namespace App\Models\Admin;

use App\Traits\Tools\Resource;
use Illuminate\Database\Eloquent\Model;

class BaseInfoSub extends Model
{
    use Resource;
    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @var array
     */
    protected $casts = [];

    public function __construct(array $attributes = [])
    {
        $this->initFillable();
        $this->initCasts();
        parent::__construct($attributes);
    }

    public function initFillable()
    {
        $this->fillable = $this->getFieldNames();
    }

    public function initCasts()
    {
        $field = $this->getFields();
        foreach ($field as $item) {
            if (in_array($item->element, ['复选框', '多图上传', '多文件上传'])) {
                $this->casts[$item->name] = 'array';
            }
        }
    }



    /**
     * 获得副表字段
     * @return mixed
     */
    public function getFields()
    {
        return (new Table())->getField($this->getModel())
            ->filter(function ($item) {
                return $item->belong === 2;
            })
            ->values();
    }

    /**
     * 获取副表字段名称
     * @return mixed
     */
    public function getFieldNames()
    {
        return $this->getFields()->map(function ($item) {
            return $item->name;
        })->toArray();
    }

}
