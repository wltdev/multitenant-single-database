<?php

namespace App\Repositories\City;

use App\Models\City;

class CityRepository implements CityRepositoryInterface
{
    public function __construct(private City $model) {}
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

    public function findOrCreate($payload)
    {
        $record = $this->model->firstOrNew($payload);
        $record->save();

        return $record;
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
