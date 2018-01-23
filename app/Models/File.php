<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'model', 'info_id', 'name', 'path', 'mime', 'size', 'type', 'is_admin', 'mark'
    ];

    public function getPathAttribute($value)
    {
        return Storage::disk('images')->url($value);
    }
}
