<?php

namespace App\Repositories\Province;

use App\Models\Province;

class ProvinceRepository implements ProvinceRepositoryInterface
{
    public function __construct(private Province $model) {}
    public function getAll()
    {
        $records = $this->model->orderBy('name')->get();
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

    public function findByCode($code)
    {
        $record = $this->model->where('code', $code)->first();
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
