<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'table_id', 'name', 'display_name', 'type', 'default_value', 'is_show', 'sort'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * @param $value
     */
    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = array_search($value, config('enum.Field.type.data'));
    }

    /**
     * @param $value
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getTypeAttribute($value)
    {
        $field = config('enum.Field.type.data');
        return isset($field[$value]) ? $field[$value] : config('enum.Field.type.default');
    }
}
