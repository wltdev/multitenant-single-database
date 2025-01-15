<?php

namespace App\Repositories\Permission;

use App\Models\Permission;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface PermissionRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(Permission $model);
}
