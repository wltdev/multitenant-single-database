<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface GenericRepositoryInterface
{
    public function getAll();
    public function store(array $payload);
    public function insert(array $payload);
    public function find($id);
    public function update(array $payload, $id);
    public function destroy($id);
}
