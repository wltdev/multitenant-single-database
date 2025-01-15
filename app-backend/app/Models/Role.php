<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use App\Traits\BelongsToTenant;

class Role extends SpatieRole
{
    use BelongsToTenant;

    public static function boot()
    {
        parent::boot();
        static::bootBelongsToTenant();
    }
}
