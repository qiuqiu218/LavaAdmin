<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'is_sub_table', 'type'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * 根据table表关联查找出的field表集合
     *
     * @var null
     */
    protected $field_collect = null;

    public function field()
    {
        return $this->hasMany('App\Models\Field');
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function getField($name)
    {
        if ($this->field_collect) {
           return $this->field_collect;
        }
        $table = self::query()->where('name', $name)->first();
        $this->field_collect = $table->field;
        return $table->field;
    }
}
