<?php

namespace App\Repositories\Project;

use App\Models\Project;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface ProjectRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(Project $model);
    public function syncMembers(Project $project, array $members);
}
