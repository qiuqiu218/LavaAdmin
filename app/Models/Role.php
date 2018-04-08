<?php

namespace App\Models;

class Role extends \Spatie\Permission\Models\Role
{
    /**
     * @param $id
     * @return mixed
     */
    public static function getPermission($id)
    {
        return self::query()
                    ->findOrFail($id)
                    ->permissions
                    ->map(function ($item) {
                        return $item->name;
                    })
                    ->toArray();
    }
}
