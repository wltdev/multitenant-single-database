<?php

namespace App\Repositories\Company;

use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function __construct(private Company $model) {}

    public function getAll()
    {
        $records = $this->model->all();
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
