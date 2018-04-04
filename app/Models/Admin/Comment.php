<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'table_id',
        'info_id',
        'user_id',
        'content',
        'images',
        'grade',
        'anonymity'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'images' => 'array'
    ];
}
