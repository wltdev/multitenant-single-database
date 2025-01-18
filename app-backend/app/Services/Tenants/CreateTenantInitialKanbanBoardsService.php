<?php

namespace App\Services\Tenants;

use App\Repositories\KanbanBoard\KanbanBoardRepositoryInterface;
use App\Repositories\KanbanBoardColumn\KanbanBoardColumnRepositoryInterface;

class CreateTenantInitialKanbanBoardsService
{
    public function __construct(
        private KanbanBoardRepositoryInterface $kanbanBoardRepository,
        private KanbanBoardColumnRepositoryInterface $kanbanBoardColumnRepository
    ) {}

    public function execute($tenant_id)
    {
        $boards = [
            [
                'name' => 'Lead Board',
                'type' => 'lead',
                'description' => 'Lead Kanban Board',
                'tenant_id' => $tenant_id
            ],
            [
                'name' => 'Project Board',
                'type' => 'project',
                'description' => 'Project Kanban Board',
                'tenant_id' => $tenant_id
            ],
            [
                'name' => 'Task Board',
                'type' => 'task',
                'description' => 'Task Kanban Board',
                'tenant_id' => $tenant_id
            ]
        ];

        foreach ($boards as $board) {
            $record = $this->kanbanBoardRepository->store($board);

            $columns = [
                [
                    'kanban_board_id' => $record->id,
                    'name' => 'A Fazer',
                    'order' => 1
                ],
                [
                    'kanban_board_id' => $record->id,
                    'name' => 'Em Andamento',
                    'order' => 2
                ],
                [
                    'kanban_board_id' => $record->id,
                    'name' => 'Concluído',
                    'order' => 3
                ]
            ];

            $this->kanbanBoardColumnRepository->insert($columns);
        }
    }
}
