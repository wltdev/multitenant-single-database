<?php

namespace App\Http\Controllers;

use App\DTOs\ProjectDTO;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Services\Projects\CreateProjectService;
use App\Services\Projects\GetAllProjectService;
use App\Services\Projects\GetOneProjectService;
use App\Services\Projects\RemoveProjectService;
use App\Services\Projects\UpdateProjectService;
use Illuminate\Http\JsonResponse;

class ProjectsController extends Controller
{
    public function __construct(
        private CreateProjectService $createProjectService,
        private GetAllProjectService $getAllProjectService,
        private GetOneProjectService $getOneProjectService,
        private UpdateProjectService $updateProjectService,
        private RemoveProjectService $removeProjectService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $records = $this->getAllProjectService->execute();

        return response()->json(ProjectResource::collection($records));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        $dto = new ProjectDTO($request->all(), $request->file('file'));

        $record = $this->createProjectService->execute($dto);

        return response()->json(
            new ProjectResource($record),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $record = $this->getOneProjectService->execute($id);

        return response()->json(
            new ProjectResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, $id): JsonResponse
    {
        $dto = new ProjectDTO($request->all(), $request->file('file'));

        $record = $this->updateProjectService->execute($dto, $id);

        return response()->json(
            new ProjectResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->removeProjectService->execute($id);

        return response()->json(
            [],
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
