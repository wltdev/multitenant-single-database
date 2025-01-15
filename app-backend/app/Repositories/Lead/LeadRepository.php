<?php

namespace App\Repositories\Lead;

use App\Models\Lead;

class LeadRepository implements LeadRepositoryInterface
{
    public function __construct(private Lead $model) {}

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

    public function findByBoardColumnId($id)
    {
        $record = $this->model->where('kanban_board_column_id', $id)->orderBy('kanban_board_column_order', 'asc')->get();
        return $record;
    }

    public function findAndUpdateByBoardColumnId(int $id, array $data)
    {
        $record = $this->model->where('kanban_board_column_id', $id)->first();

        $record->fill($data);
        $record->save();

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
