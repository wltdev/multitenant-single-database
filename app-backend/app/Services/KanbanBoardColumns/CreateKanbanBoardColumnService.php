<?php

namespace App\Services\KanbanBoardColumns;

use App\Repositories\KanbanBoardColumn\KanbanBoardColumnRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CreateKanbanBoardColumnService
{

    public function __construct(private KanbanBoardColumnRepositoryInterface $repository) {}

    public function execute($request)
    {
        try {
            DB::beginTransaction();

            $record = $this->repository->store($request);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
