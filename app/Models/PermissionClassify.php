<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionClassify extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sort', 'guard_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permission()
    {
        return $this->hasMany('App\Models\Permission');
    }

    public static function getAllPermission()
    {
        return self::query()
                    ->with('permission')
                    ->where('name', '<>', '菜单管理')
                    ->orderBy('sort')
                    ->get();
    }
}
