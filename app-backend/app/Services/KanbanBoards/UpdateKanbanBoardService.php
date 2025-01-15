<?php

namespace App\Services\KanbanBoards;

use App\Repositories\KanbanBoard\KanbanBoardRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class UpdateKanbanBoardService
{

    public function __construct(private KanbanBoardRepositoryInterface $repository) {}

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
