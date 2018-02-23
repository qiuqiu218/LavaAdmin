<?php

namespace App\Models;

use App\Traits\Tools\Resource;
use Illuminate\Database\Eloquent\Model;

class BaseInfo extends Model
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
        $this->fillable = (new Table())->getField($this->getModel())->map(function ($item) {
            return $item->name;
        })->toArray();
    }

    public function initCasts()
    {
        $field = (new Table())->getField($this->getModel());
        foreach ($field as $item) {
            if ($item->type === '复选框') {
                $this->casts[$item->name] = 'array';
            }
        }
    }

    /**
     * 获取列表显示的字段 返回object，用于显示名称
     * 字段必须为主表且可显示
     * @return mixed
     */
    public function getTableCol()
    {
        return (new Table())
                    ->getField($this->getModel())
                    ->filter(function ($item) {
                        return $item->belong === 1 && $item->is_show;
                    });
    }

    /**
     * 获取可输入的内容字段
     * @return mixed
     */
    public function getTableDetailField()
    {
        $data = (new Table())
                    ->getField($this->getModel())
                    ->filter(function ($item) {
                        return $item->is_import === 1;
                    });
        return $data;
    }

    /**
     * 获取当前模型数据
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTableData()
    {
        $data = self::query()->get();
        $field = (new Table())->getField($this->getModel());
        // 获取下拉框，单选框，复选框字段
        $changeField = $field
            ->filter(function ($item) {
                return $item->type === '复选框' || $item->type === '单选框' || $item->type === '下拉框';
            })
            ->values()
            ->map(function ($item) {
                return $item->name;
            })
            ->toArray();

        // 将值转换为文本
        foreach ($changeField as $key) {
            $f = $field->where('name', $key)->values()[0];
            $data = $data->map(function ($item) use ($key, $f) {
                if (is_array($item->$key)) {
                    $item->$key = collect($f->default_value)
                                ->whereIn('value', $item->$key)
                                ->map(function ($item) {
                                    return $item['text'];
                                })
                                ->implode(',');
                } else {
                    $arr = collect($f->default_value)->where('value', $item->$key)->values();
                    if (count($arr) > 0) {
                       $item->$key = $arr[0]['text'];
                    }
                }
                return $item;
            });
        }
        return $data;
    }

    /**
     * 获取列表显示字段 ['id', 'name']
     * @return mixed
     */
    public function getTableListField()
    {
        return $this->getTableCol()->map(function ($item) {
            return $item->name;
        })->toArray();
    }
}
