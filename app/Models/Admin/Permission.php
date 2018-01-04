<?php

namespace App\Models\Admin;

class Permission extends \Spatie\Permission\Models\Permission
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission_classify()
    {
        return $this->belongsTo('App\Models\Admin\PermissionClassify');
    }
}
