<?php

namespace App\Services\KanbanBoards;

use App\Repositories\KanbanBoard\KanbanBoardRepositoryInterface;
use Mockery\Exception;

class GetAllKanbanBoardService
{

    public function __construct(private KanbanBoardRepositoryInterface $repository) {}

    public function execute()
    {
        return $this->repository->getAll();
    }
}
