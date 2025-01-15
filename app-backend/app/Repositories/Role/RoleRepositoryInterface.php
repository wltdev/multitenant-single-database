<?php

namespace App\Repositories\Role;

use App\Repositories\Interfaces\GenericRepositoryInterface;
use App\Models\Role;

interface RoleRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(Role $model);
}
