<?php

namespace App\Services\Clients;

use App\Repositories\Client\ClientRepositoryInterface;
use Mockery\Exception;

class GetAllClientService
{

    public function __construct(private ClientRepositoryInterface $repository) {}

    public function execute()
    {
        try {
            $records = $this->repository->getAll();
            return $records;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
