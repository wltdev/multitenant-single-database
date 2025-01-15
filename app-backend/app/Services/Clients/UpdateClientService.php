<?php

namespace App\Services\Clients;

use App\DTOs\ClientDTO;
use App\Repositories\Client\ClientRepositoryInterface;
use App\Services\Addresses\UpdateAddressService;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UpdateClientService
{

    public function __construct(private ClientRepositoryInterface $repository, private UpdateAddressService $updateAddressService) {}

    public function execute(ClientDTO $payload, $id)
    {
        try {
            DB::beginTransaction();

            $this->updateAddressService->execute($payload->address->toArray(), $payload->address_id);

            $clientData = $payload->toArray();

            unset($clientData['address']);

            $record = $this->repository->update($clientData, $id);

            // Attach the file using Spatie Media Library
            if ($payload->file) {
                // Clear the existing files
                $record->clearMediaCollection('clients');
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
