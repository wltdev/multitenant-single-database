<?php

namespace App\Services\KanbanBoardColumns;

use App\Repositories\KanbanBoardColumn\KanbanBoardColumnRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class RemoveKanbanBoardColumnService
{

    public function __construct(private KanbanBoardColumnRepositoryInterface $repository) {}

    public function execute($id)
    {
        try {
            DB::beginTransaction();

            $record = $this->repository->destroy($id);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
