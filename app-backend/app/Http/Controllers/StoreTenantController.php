<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreTenantRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\TenantResource;
use Illuminate\Http\JsonResponse;
use App\Services\Tenants\CreateTenantService;
use Illuminate\Support\Facades\Auth;

class StoreTenantController extends Controller
{
    public function __construct(private CreateTenantService $createTenantService) {}

    public function store(StoreTenantRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $response = $this->createTenantService->execute($payload);

        return response()->json(
            [
                'user' => new AuthResource($response['user']),
                'tenant' => new TenantResource($response['tenant']),
                'token' => $response['token'],
                'token_type' => 'Bearer'
            ],
            JsonResponse::HTTP_CREATED
        );
    }
}
