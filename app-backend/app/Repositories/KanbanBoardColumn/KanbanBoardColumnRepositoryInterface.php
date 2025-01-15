<?php

namespace App\Repositories\KanbanBoardColumn;

use App\Models\KanbanBoardColumn;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface KanbanBoardColumnRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(KanbanBoardColumn $model);

    public function findByKanbanBoardId($kanbanBoardId);
}
