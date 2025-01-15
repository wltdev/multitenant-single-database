<?php

namespace App\Services\Leads;

use App\Repositories\Lead\LeadRepositoryInterface;
use Exception;

class GetOneLeadService
{
    public function __construct(private LeadRepositoryInterface $repository) {}

    public function execute($id)
    {
        try {
            return $this->repository->find($id);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
