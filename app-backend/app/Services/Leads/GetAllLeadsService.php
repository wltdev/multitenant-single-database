<?php

namespace App\Services\Leads;

use App\Repositories\Lead\LeadRepositoryInterface;
use Exception;

class GetAllLeadsService
{
    public function __construct(private LeadRepositoryInterface $repository) {}

    public function execute()
    {
        try {
            return $this->repository->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
