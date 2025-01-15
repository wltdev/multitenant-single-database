<?php

namespace App\Services\Clients;

use App\DTOs\ClientDTO;
use App\Repositories\Client\ClientRepositoryInterface;
use App\Services\Addresses\CreateAddressService;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CreateClientService
{

    public function __construct(private ClientRepositoryInterface $repository, private CreateAddressService $createAddressService) {}

    public function execute(ClientDTO $payload)
    {
        try {
            DB::beginTransaction();

            $address = $this->createAddressService->execute($payload->address->toArray());

            $clientData = $payload->toArray();

            unset($clientData['address']);

            $clientData['address_id'] = $address->id;

            $record = $this->repository->store($clientData);

            // Attach the file using Spatie Media Library
            if ($payload->file) {
                $record->addMedia($payload->file)
                    ->toMediaCollection('clients'); // Specify the collection name
            }

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
