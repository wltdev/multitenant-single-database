<?php

namespace App\Services\KanbanBoards;

use App\Repositories\Lead\LeadRepositoryInterface;

class GetKanbanBoardColumnCardsService
{
    public function __construct(
        private LeadRepositoryInterface $leadRepository
    ) {}
    public function execute(int $column_id, string $type)
    {
        $records = null;

        if ($type == 'lead') {
            $records = $this->leadRepository->findByBoardColumnId($column_id);
        }

        return $records;
    }
}
