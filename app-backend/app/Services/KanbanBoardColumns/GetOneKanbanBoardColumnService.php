<?php

namespace App\Services\KanbanBoardColumns;

use App\Repositories\KanbanBoardColumn\KanbanBoardColumnRepositoryInterface;
use Mockery\Exception;

class GetOneKanbanBoardColumnService
{

    public function __construct(private KanbanBoardColumnRepositoryInterface $repository) {}

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
