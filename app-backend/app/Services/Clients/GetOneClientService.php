<?php

namespace App\Services\Clients;

use App\Repositories\Client\ClientRepositoryInterface;
use Mockery\Exception;

class GetOneClientService
{

    public function __construct(private ClientRepositoryInterface $repository) {}

    public function execute($id)
    {
        try {
            $records = $this->repository->find($id);
            return $records;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
