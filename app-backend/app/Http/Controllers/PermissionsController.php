<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Services\Permissions\CreatePermissionService;
use App\Services\Permissions\DeletePermissionService;
use App\Services\Permissions\GetAllPermissionsService;
use App\Services\Permissions\GetOnePermissionService;
use App\Services\Permissions\UpdatePermissionService;
use Illuminate\Http\JsonResponse;

class PermissionsController extends Controller
{
    private $repository;

    public function __construct(
        private CreatePermissionService $createPermissionService,
        private GetAllPermissionsService $getAllPermissionService,
        private GetOnePermissionService $getOnePermissionService,
        private UpdatePermissionService $updatePermissionService,
        private DeletePermissionService $deletePermissionService,
        PermissionRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // $records = $this->getAllPermissionService->execute();
        $permissions = config('permissions');

        // return response()->json(PermissionResource::collection($records));

        return response()->json($permissions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request): JsonResponse
    {
        $record = $this->createPermissionService->execute($request->validated());

        return response()->json(
            new PermissionResource($record),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $record = $this->getOnePermissionService->execute($id);

        return response()->json(
            new PermissionResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, $id): JsonResponse
    {
        $record = $this->updatePermissionService->execute($request->validated(), $id);

        return response()->json(
            new PermissionResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->deletePermissionService->execute($id);

        return response()->json(
            [],
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
