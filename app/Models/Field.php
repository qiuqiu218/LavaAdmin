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
}
