<?php

namespace App\Models\Admin;

use App\Traits\Tools\Resource;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use Resource;
    /**
     * @var array
     */
    protected $fillable = [
        'table_id', 'name', 'display_name', 'type', 'default_value', 'option', 'belong', 'is_show', 'is_import', 'is_system', 'sort'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'option' => 'array'
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

    /**
     * 关联表信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function table()
    {
        return $this->belongsTo('App\Models\Admin\Table');
    }
}
