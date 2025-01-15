<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface UserRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(User $model);
}
