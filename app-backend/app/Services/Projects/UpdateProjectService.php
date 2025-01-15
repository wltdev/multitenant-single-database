<?php

namespace App\Services\Projects;

use App\DTOs\ProjectDTO;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Services\Addresses\UpdateAddressService;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UpdateProjectService
{

    public function __construct(private ProjectRepositoryInterface $repository) {}

    public function execute(ProjectDTO $payload, $id)
    {
        try {
            DB::beginTransaction();

            $ProjectData = $payload->toArray();

            $record = $this->repository->update($ProjectData, $id);

            // Attach the file using Spatie Media Library
            if ($payload->file) {
                // Clear the existing files
                // $record->clearMediaCollection('Projects');

                $record->addMedia($payload->file)
                    ->toMediaCollection('Projects'); // Specify the collection name
            }

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
