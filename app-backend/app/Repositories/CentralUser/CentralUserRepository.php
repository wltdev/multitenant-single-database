<?php

namespace App\Repositories\CentralUser;

use App\Models\CentralUser;

class CentralUserRepository implements CentralUserRepositoryInterface
{
    public function __construct(private CentralUser $model) {}

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

        // Remove user from central by email, because IDs is differente
        tenancy()->central(function ($tenant) use ($email) {
            $recordCentral = $this->model->where('email', $email)->first();

            if ($recordCentral) {
                $recordCentral->delete();
            }
        });
    }
}
