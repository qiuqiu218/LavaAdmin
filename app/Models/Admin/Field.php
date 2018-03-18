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
        'table_id', 'name', 'display_name', 'type', 'default_value', 'belong', 'is_show', 'is_import', 'is_system', 'sort'
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

    public function getDefaultValueAttribute($value)
    {
        if (in_array($this->type, ['下拉框', '单选框', '复选框']) && $this->getModel() !== 'Field') {
            if (str_contains($value, "\r\n")) {
                $select = collect(explode("\r\n", $value));
            } else {
                $select = collect(explode("\n", $value));
            }
            try {
                $obj = $select->map(function ($item) {
                    list($val, $text) = explode("==", $item);
                    $active = 0;
                    if (str_contains($text, ':default')) {
                        $text = str_before($text, ':default');
                        $active = 1;
                    }

                    return [
                        'value' => $val,
                        'text' => $text,
                        'active' => $active
                    ];
                })->toArray();
                return $obj;
            } catch (\Exception $e) {
                return [];
            }
        } else {
            return $value;
        }
    }
}
