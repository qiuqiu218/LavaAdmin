<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
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
