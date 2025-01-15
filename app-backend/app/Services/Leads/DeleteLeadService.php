<?php

namespace App\Services\Leads;

use App\Repositories\Lead\LeadRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class DeleteLeadService
{
    public function __construct(private LeadRepositoryInterface $repository) {}


    public function execute(int $id)
    {
        try {
            DB::beginTransaction();

            $deleted = $this->repository->destroy($id);

            DB::commit();

            return $deleted;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
