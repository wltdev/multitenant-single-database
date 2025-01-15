<?php

namespace App\Repositories\KanbanBoardColumn;

use App\Models\KanbanBoardColumn;

class KanbanBoardColumnRepository implements KanbanBoardColumnRepositoryInterface
{
    public function __construct(private KanbanBoardColumn $model) {}

    public function getAll()
    {
        $records = $this->model->get();
        return $records;
    }

    public function store(array $payload)
    {
        return $this->model->create($payload);
    }

    public function insert(array $payload)
    {
        return $this->model->insert($payload);
    }

    public function find($id)
    {
        $record = $this->model->findOrFail($id);
        return $record;
    }

    public function findByKanbanBoardId($kanbanBoardId)
    {
        $record = $this->model->where('kanban_board_id', $kanbanBoardId)->get();
        return $record;
    }

    public function update($payload, $id)
    {
        $record = $this->model->findOrFail($id);

        $record->fill($payload);
        $record->save();

        return $record;
    }

    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
    }
}
