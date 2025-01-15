<?php

namespace App\Services\KanbanBoards;

use App\Repositories\KanbanBoard\KanbanBoardRepositoryInterface;
use App\Repositories\KanbanBoardColumn\KanbanBoardColumnRepositoryInterface;

class GetOneKanbanBoardService
{

    public function __construct(
        private KanbanBoardRepositoryInterface $repository,
        private KanbanBoardColumnRepositoryInterface $columnRepository,
        private GetKanbanBoardColumnCardsService $cardsService,
    ) {}

    public function execute($id, $type = null): object
    {
        $record = $type ? $this->repository->findByType($type) : $this->repository->find($id);

        if (!$record) {
            throw new \Exception("Kanban board not found");
        }

        $columns = $this->columnRepository->findByKanbanBoardId($record->id);

        $record->columns = $columns;

        foreach ($record->columns as $column) {
            $column->cards = $this->cardsService->execute($column->id, $record->type);
        }

        return $record;
    }
}
