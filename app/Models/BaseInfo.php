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
    protected $fillable = ['title'];

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

    /**
     * 如果存在副表则与副表关联
     * @return $this|\Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subTable()
    {
        return $this->hasOne('App\Models\\'.ucfirst($this->getModel()).'Sub');
    }

    public function initFillable()
    {
        $this->fillable = $this->getMainFieldNames();
    }

    public function initCasts()
    {
        $field = $this->getMainFields();
        foreach ($field as $item) {
            if (in_array($item->element, ['复选框', '多图上传', '多文件上传'])) {
                $this->casts[$item->name] = 'array';
            }
        }
    }

    /**
     * 获得主表字段
     * @return mixed
     */
    public function getMainFields()
    {
        return (new Table())->getField($this->getModel())
            ->filter(function ($item) {
                return $item->belong === 1;
            })
            ->values();
    }

    /**
     * 获取主表字段名称
     * @return mixed
     */
    public function getMainFieldNames()
    {
        return $this->getMainFields()->map(function ($item) {
            return $item->name;
        })->toArray();
    }

    /**
     * 获得副表字段
     * @return mixed
     */
    public function getSubFields()
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
    public function getSubFieldNames()
    {
        return $this->getSubFields()->map(function ($item) {
           return $item->name;
        })->toArray();
    }

    /**
     * 是否存在副表
     * @return mixed
     */
    public function isSubTable()
    {
        $res = (new Table())->getTableInfo($this->getModel())->is_sub_table;
        return $res;
    }

    /**
     * 获取列表显示的字段 返回object，用于显示名称
     * 字段必须为主表且可显示
     * @return mixed
     */
    public function getTableListFields()
    {
        return $this->getMainFields()
                ->filter(function ($item) {
                    return $item->is_show;
                })
                ->values();
    }

    /**
     * 获取列表显示字段 ['id', 'name']
     * @return mixed
     */
    public function getTableListFieldNames()
    {
        return $this->getTableListFields()->map(function ($item) {
            return $item->name;
        })->toArray();
    }

    /**
     * 获取可输入的表单内容字段
     * @return mixed
     */
    public function getFormDetailFields()
    {
        return (new Table())->getField($this->getModel())
                    ->filter(function ($item) {
                        return $item->is_import === 1;
                    })
                    ->values();
    }

    /**
     * 获取列表显示字段
     * @return mixed
     */
    public function getListShowFields()
    {
        return (new Table())->getField($this->getModel())
                    ->filter(function ($item) {
                        return $item->is_show === 1;
                    })
                    ->values();
    }

    /**
     * 获取当前模型数据
     * @param $data
     * @return mixed
     */
    public function getTableData($data)
    {
        $field = $this->getListShowFields();

        // 获取要替换的字段
        $changeField = $field->filter(function ($item) {
            return in_array($item->element, ['下拉框', '单选框', '复选框', '多图上传', '多文件上传']);
        });

        if ($changeField->count()) {
            $data = $data->each(function ($item) use ($changeField) {
                $changeField->each(function ($f) use ($item) {
                    switch ($f->element) {
                        case '多图上传':
                            $item[$f->name] = $this->replaceImages($item[$f->name]);
                            break;
                        case '多文件上传':
                            $item[$f->name] = $this->replaceFiles($item[$f->name]);
                            break;
                        case '下拉框':
                            $item[$f->name] = $this->replaceSelect($item[$f->name], $f);
                            break;
                        case '单选框':
                            $item[$f->name] = $this->replaceRadio($item[$f->name], $f);
                            break;
                        case '复选框':
                            $item[$f->name] = $this->replaceCheckbox($item[$f->name], $f);
                            break;
                    }
                });
            });
        }

        return $data;
    }

    // 获取下拉框的替换文本
    public function replaceSelect($value, $field)
    {
        foreach ($field->option as $item) {
            if ($item['value'] === $value) {
                return $item['text'];
                break;
            }
        }
        return $value;
    }

    // 获取单选框的替换文本
    public function replaceRadio($value, $field)
    {
        return $this->replaceSelect($value, $field);
    }

    // 获取复选框的替换文本
    public function replaceCheckbox($value, $field)
    {
        return collect($field->option)
            ->whereIn('value', $value)
            ->map(function ($item) {
                return $item['text'];
            })
            ->implode(',');
    }
    
    // 获取多图上传字段的替换文本
    public function replaceImages($value)
    {
        if (is_array($value)) {
            return implode(",", $value);
        } else {
            return $value;
        }
    }

    // 获取多文件上传字段的替换文本
    public function replaceFiles($value)
    {
        return $this->replaceImages($value);
    }
}
