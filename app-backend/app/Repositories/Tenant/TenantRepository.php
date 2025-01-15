<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant;

class TenantRepository implements TenantRepositoryInterface
{
    public function __construct(private Tenant $model) {}

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

    public function update($payload, $id)
    {
        $record = $this->model->findOrFail($id);

        if ($payload['role']) {
            $record->syncRoles([$payload['role']]);
        }

        $record->fill($payload);
        $record->save();

        return $record;
    }

    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $email = $record->email;
        $record->delete();
    }
}
