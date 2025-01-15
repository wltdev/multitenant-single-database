<?php

namespace App\Services\Clients;

use App\Repositories\Client\ClientRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class RemoveClientService
{

    public function __construct(private ClientRepositoryInterface $repository) {}

    public function execute($id)
    {
        try {
            DB::beginTransaction();

            $record = $this->repository->find($id);

            $record->clearMediaCollection('clients');

            $record = $this->repository->destroy($id);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
