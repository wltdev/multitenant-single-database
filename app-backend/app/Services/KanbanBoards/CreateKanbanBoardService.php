<?php

namespace App\Services\KanbanBoards;

use App\Repositories\KanbanBoard\KanbanBoardRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class CreateKanbanBoardService
{

    public function __construct(private KanbanBoardRepositoryInterface $repository) {}

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
