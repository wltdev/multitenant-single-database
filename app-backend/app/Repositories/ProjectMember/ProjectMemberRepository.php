<?php

namespace App\Repositories\ProjectMember;

use App\Models\ProjectMember;

class ProjectMemberRepository implements ProjectMemberRepositoryInterface
{
    public function __construct(private ProjectMember $model) {}
    public function getAll()
    {
        $records = $this->model->orderBy('created_at', 'desc')->get();
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
