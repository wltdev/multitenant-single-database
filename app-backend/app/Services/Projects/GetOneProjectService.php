<?php

namespace App\Services\Projects;

use App\Repositories\Project\ProjectRepositoryInterface;
use Mockery\Exception;

class GetOneProjectService
{

    public function __construct(private ProjectRepositoryInterface $repository) {}

    public function execute($id)
    {
        try {
            $records = $this->repository->find($id);
            return $records;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
