<?php

namespace App\Models\Admin;

use Baum\Node;

class Menu extends Node
{
    /**
     * @var string
     */
    protected $table = 'menus';

    /**
     * @var string
     */
    protected $orderColumn = 'sort';
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

    public function getPath()
    {
        return $this->getAncestors(['id'])->map(function ($item) {
            return $item->id;
        });
    }

    public function getChildrenAndSelf()
    {
        return $this->getDescendantsAndSelf(['id'])->map(function ($item) {
            return $item->id;
        });
    }
}
