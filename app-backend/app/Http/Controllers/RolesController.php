<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Schema(
 *     schema="ResponseRole",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *      @OA\Property(
 *         property="permissions",
 *         type="array",
 *         @OA\Items(type="string")
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string"
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="Role",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *      @OA\Property(
 *         property="role",
 *         type="string"
 *     ),
 *      @OA\Property(
 *         property="password",
 *         type="string"
 *     )
 * )
 */
class RolesController extends Controller
{
    private $repository;

    public function __construct(RoleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @OA\Get(
     *     path="/roles",
     *     tags={"Roles"},
     *     summary="Get list of roles",
     *     @OA\Response(
     *         response=200,
     *         description="A list of roles",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ResponseRole"))
     *     )
     * )
     *
     */
    public function index(): JsonResponse
    {
        $records = $this->repository->getAll();

        return response()->json(RoleResource::collection($records));
    }

    /**
     * @OA\Post(
     *     path="/roles",
     *     tags={"Roles"},
     *     summary="Create new role",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Role")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Role created",
     *         @OA\JsonContent(ref="#/components/schemas/ResponseRole")
     *     )
     * )
     *
     */
    public function store(StoreRoleRequest $request): JsonResponse
    {
        $payload = [
            'name' => $request->validated()['name']
        ];

        $record = $this->repository->store($payload);
        $record->syncPermissions($request->validated()['permissions']);

        return response()->json(
            new RoleResource($record),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     *  @OA\Get(
     *     path="/roles/{id}",
     *     tags={"Roles"},
     *     summary="Get single role",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A single role",
     *         @OA\JsonContent(ref="#/components/schemas/Role")
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $record = $this->repository->find($id);

        return response()->json(
            new RoleResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @OA\Put(
     *     path="/roles/{id}",
     *     tags={"Roles"},
     *     summary="Update role",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Role")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Role updated",
     *         @OA\JsonContent(ref="#/components/schemas/ResponseRole")
     *     )
     * )
     *
     */
    public function update(UpdateRoleRequest $request, $id): JsonResponse
    {
        $payload = [
            'name' => $request->validated()['name']
        ];

        $record = $this->repository->update($payload, $id);
        $record->syncPermissions($request->validated()['permissions']);

        return response()->json(
            new RoleResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @OA\Delete(
     *     path="/roles/{id}",
     *     tags={"Roles"},
     *     summary="Delete role",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Role deleted"
     *     )
     * )
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);

        return response()->json(
            [],
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
