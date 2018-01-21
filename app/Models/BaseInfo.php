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

    public function __construct()
    {
        parent::__construct();

        $this->initFillable();
    }

    public function initFillable()
    {
        $this->fillable = (new Table())->getField($this->getModel())->map(function ($item) {
            return $item->name;
        })->toArray();
    }

    /**
     * 获取列表显示的字段 返回object，用于显示名称
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
        return self::query()->get();
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
