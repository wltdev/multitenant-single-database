<?php

namespace App\Services\Projects;

use App\DTOs\ProjectDTO;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Repositories\ProjectMember\ProjectMemberRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateProjectService
{

    public function __construct(
        private ProjectRepositoryInterface $repository,
        private ProjectMemberRepositoryInterface $projectMemberRepository
    ) {}

    public function execute(ProjectDTO $payload)
    {
        try {
            DB::beginTransaction();

            $data = $payload->toArray();

            $record = $this->repository->store($data);

            if (count($data['members'])) {
                foreach ($data['members'] as $member) {
                    $this->projectMemberRepository->store([
                        'user_id' => $member['user_id'],
                        'role' => $member['role'],
                        'project_id' => $record->id
                    ]);
                }
            }

            if ($payload->files) {
                foreach ($payload->files as $file) {
                    $record->addMedia($file)
                        ->toMediaCollection('project_files'); // Specify the collection name
                }
            }

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
