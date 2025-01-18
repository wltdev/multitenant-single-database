<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Schema(
 *     schema="ResponseUser",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string"
 *     ),
 *      @OA\Property(
 *         property="company_id",
 *         type="integer"
 *     ),
 *      @OA\Property(
 *         property="role",
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
 *     schema="User",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string"
 *     ),
 *      @OA\Property(
 *         property="company_id",
 *         type="integer"
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
class UsersController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @OA\Get(
     *     path="/users",
     *     tags={"Users"},
     *     summary="Get list of users",
     *     @OA\Response(
     *         response=200,
     *         description="A list of users",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ResponseUser"))
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $records = $this->userRepository->getAll();

        return response()->json(UserResource::collection($records));
    }


    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     tags={"Users"},
     *     summary="Get single user",
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
     *         description="A single user",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $record = $this->userRepository->find($id);

        return response()->json(new UserResource($record));
    }


    /**
     * @OA\Post(
     *     path="/users",
     *     tags={"Users"},
     *     summary="Create new user",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created",
     *         @OA\JsonContent(ref="#/components/schemas/ResponseUser")
     *     )
     * )
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $payload = $request->all();
        $payload['tenant_id'] = auth()->user()->tenant_id;

        $record = $this->userRepository->store($payload);
        $record->assignRole($request->validated()['role']);

        return response()->json(
            new UserResource($record),
            201
        );
    }


    /**
     * @OA\Put(
     *     path="/users/{id}",
     *     tags={"Users"},
     *     summary="Update user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated",
     *         @OA\JsonContent(ref="#/components/schemas/ResponseUser")
     *     )
     * )
     */
    public function update(UpdateUserRequest $request, $id): JsonResponse
    {
        $record = $this->userRepository->update($request->all(), $id);

        return response()->json(new UserResource($record));
    }


    /**
     * @OA\Delete(
     *     path="/users/{id}",
     *     tags={"Users"},
     *     summary="Delete user",
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
     *         description="User deleted"
     *     )
     * )
     */
    public function destroy($id)
    {
        $this->userRepository->destroy($id);

        return response()->json([], 204);
    }
}
