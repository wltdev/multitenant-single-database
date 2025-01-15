<?php

namespace App\Services\KanbanBoardColumns;

use App\Repositories\KanbanBoardColumn\KanbanBoardColumnRepositoryInterface;
use App\Repositories\Lead\LeadRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class ReorderKanbanBoardColumnCardsService
{

    public function __construct(private KanbanBoardColumnRepositoryInterface $repository, private LeadRepositoryInterface $leadRepository) {}

    public function execute($columns, $type = 'lead')
    {
        if (!count($columns)) {
            throw new Exception('columns is empty');
        }

        DB::beginTransaction();

        try {
            // Loop through the columns and update only those that have changed
            foreach ($columns as $columnData) {
                // Update only the cards within the changed column if necessary
                foreach ($columnData['cards'] as $key => $cardData) {

                    if ($type === 'lead') {
                        $this->leadRepository->update([
                            'kanban_board_column_id' => $columnData['id'],
                            'kanban_board_column_order' => $key
                        ], $cardData['id']);
                    }
                }
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
