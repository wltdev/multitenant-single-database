<?php

namespace App\Services\KanbanBoards;

use App\Repositories\KanbanBoard\KanbanBoardRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class RemoveKanbanBoardService
{

    public function __construct(private KanbanBoardRepositoryInterface $repository) {}

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
