<?php

namespace App\Services\Projects;

use App\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class RemoveProjectService
{

    public function __construct(private ProjectRepositoryInterface $repository) {}

    public function execute($id)
    {
        try {
            DB::beginTransaction();

            $record = $this->repository->find($id);

            // $record->clearMediaCollection('Projects');

            $record = $this->repository->destroy($id);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
