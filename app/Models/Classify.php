<?php

namespace App\Models;

use App\Traits\Tools\Baum;
use Baum\Node;

class Classify extends Node
{
    use Baum;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'title', 'table_id', 'sort'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'lft', 'rgt', 'depth', 'created_at', 'updated_at'
    ];
}
