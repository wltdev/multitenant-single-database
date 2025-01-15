<?php

namespace App\Repositories\KanbanBoard;

use App\Models\KanbanBoard;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface KanbanBoardRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(KanbanBoard $model);

    public function findWithColumnsAndTasks($id);
    public function findByType(string $type);
}
