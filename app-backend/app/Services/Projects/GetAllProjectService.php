<?php

namespace App\Services\Projects;

use App\Repositories\Project\ProjectRepositoryInterface;
use Mockery\Exception;

class GetAllProjectService
{

    public function __construct(private ProjectRepositoryInterface $repository) {}

    public function execute()
    {
        try {
            $records = $this->repository->getAll();
            return $records;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
