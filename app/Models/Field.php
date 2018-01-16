<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'table_id', 'name', 'display_name', 'type', 'default_value', 'belong', 'is_show', 'is_import', 'sort'
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
     * @param string $value
     * @return string
     */
    public function getTypeAttribute($value)
    {
        $field = config('enum.Field.type.data');
        return isset($field[$value]) ? $field[$value] : config('enum.Field.type.default');
    }
}
