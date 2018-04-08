<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'is_sub_table', 'is_classify', 'is_comment', 'type'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $casts = [
      'is_classify' => 'integer'
    ];

    /**
     * 根据table表关联查找出的field表集合
     *
     * @var null
     */
    protected $field_cache = [
        "name" => '',
        "fields" => null,
        "table" => null
    ];

    /**
     * 关联字段表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function field_table()
    {
        return $this->hasMany('App\Models\Field');
    }

    /**
     * 关联栏目表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menu_table()
    {
        return $this->hasMany('App\Models\Menu');
    }

    /**
     * 关联分类表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classify_table()
    {
        return $this->hasMany('App\Models\Classify');
    }

    /**
     * 关联评论表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment_table()
    {
        return $this->hasMany('App\Models\Comment');
    }
    /**
     * 获取当前表的字段集合
     * @param $name
     * @return mixed|null
     */
    public function getField($name)
    {
        if ($this->field_cache['name'] === $name) {
            return $this->field_cache['fields'];
        }
        $this->field_cache['fields'] = $this->getTableInfo($name)->field_table;
        return $this->field_cache['fields'];
    }

    /**
     * 查询当前表信息
     * @param $name
     * @return mixed
     */
    public function getTableInfo($name)
    {
        if ($this->field_cache['name'] === $name) {
            return $this->field_cache['table'];
        }
        $this->field_cache['table'] = self::query()->where('name', $name)->first();
        return $this->field_cache['table'];
    }
}
