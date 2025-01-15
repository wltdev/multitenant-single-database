<?php

namespace App\Services\Leads;

use App\Repositories\Lead\LeadRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateLeadService
{
    public function __construct(private LeadRepositoryInterface $repository) {}


    public function execute(array $payload, int $id)
    {
        DB::beginTransaction();

        try {
            $record = $this->repository->update($payload, $id);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
