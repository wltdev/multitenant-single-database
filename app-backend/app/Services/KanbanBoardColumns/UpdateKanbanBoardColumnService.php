<?php

namespace App\Services\KanbanBoardColumns;

use App\Repositories\KanbanBoardColumn\KanbanBoardColumnRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UpdateKanbanBoardColumnService
{

    public function __construct(private KanbanBoardColumnRepositoryInterface $repository) {}

    public function execute($payload, $id)
    {
        try {
            DB::beginTransaction();

            $record = $this->repository->update($payload, $id);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
