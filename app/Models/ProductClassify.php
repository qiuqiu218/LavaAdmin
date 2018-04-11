<?php

namespace App\Models;

use App\Traits\Tools\Baum;
use Baum\Node;

class ProductClassify extends Node
{
    use Baum;

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'title',
        'sort'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'lft',
        'rgt',
        'depth',
        'created_at',
        'updated_at'
    ];

    public function setParentIdAttribute($value)
    {
        $this->attributes['parent_id'] = $value ? $value : null;
    }
}
