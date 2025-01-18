<?php

namespace App\Repositories\KanbanBoard;

use App\Models\KanbanBoard;

class KanbanBoardRepository implements KanbanBoardRepositoryInterface
{
    public function __construct(private KanbanBoard $model) {}

    public function getAll($type = null)
    {
        $query = $this->model;

        if ($type) {
            $query->where('type', $type);
        }

        $records = $query->get();

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

    public function findWithColumnsAndTasks($id)
    {
        return $this->model->with(['columns.tasks'])->findOrFail($id);
    }

    public function findByType(string $type)
    {
        return $this->model->where('type', $type)->first();
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
