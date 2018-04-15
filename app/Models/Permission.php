<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'guard_name',
        'sort',
        'permission_classify_id'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission_classify()
    {
        return $this->belongsTo('App\Models\PermissionClassify');
    }

    public static function findByClassifyId($name)
    {
        $res = PermissionClassify::query()->where('name', $name)->first();
        return $res ? $res->id : 0;
    }
}
