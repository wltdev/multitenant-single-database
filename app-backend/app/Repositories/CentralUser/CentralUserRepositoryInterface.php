<?php

namespace App\Repositories\CentralUser;

use App\Models\CentralUser;
use App\Models\User;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface CentralUserRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(CentralUser $model);
}
