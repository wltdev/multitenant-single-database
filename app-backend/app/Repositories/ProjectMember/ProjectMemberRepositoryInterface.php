<?php

namespace App\Repositories\ProjectMember;

use App\Models\ProjectMember;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface ProjectMemberRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(ProjectMember $model);
}
