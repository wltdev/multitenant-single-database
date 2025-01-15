<?php

namespace App\Services\KanbanBoardColumns;

use App\Repositories\KanbanBoardColumn\KanbanBoardColumnRepositoryInterface;
use Mockery\Exception;

class GetAllKanbanBoardColumnService
{

    public function __construct(private KanbanBoardColumnRepositoryInterface $repository) {}

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
