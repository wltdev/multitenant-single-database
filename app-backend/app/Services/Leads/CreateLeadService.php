<?php

namespace App\Services\Leads;

use App\Repositories\Lead\LeadRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateLeadService
{
    public function __construct(private LeadRepositoryInterface $repository) {}

    public function execute($payload)
    {
        try {
            DB::beginTransaction();

            $record = $this->repository->store($payload);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
