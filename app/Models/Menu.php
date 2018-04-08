<?php

namespace App\Models;

use App\Traits\Tools\Baum;
use Baum\Node;

class Menu extends Node
{
    use Baum;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'title', 'description', 'route', 'type', 'sort'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'lft', 'rgt', 'depth', 'created_at', 'updated_at'
    ];

    /**
     * @param $value
     */
    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = array_search($value, config('enum.Menu.type.data'));
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getTypeAttribute($value)
    {
        $value = $value ? $value : 0;
        return config('enum.Menu.type.data')[$value];
    }
}
