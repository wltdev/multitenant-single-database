<?php

namespace App\Http\Controllers;

use App\DTOs\ClientDTO;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Services\Clients\CreateClientService;
use App\Services\Clients\GetAllClientService;
use App\Services\Clients\GetOneClientService;
use App\Services\Clients\RemoveClientService;
use App\Services\Clients\UpdateClientService;
use Illuminate\Http\JsonResponse;

class ClientsController extends Controller
{
    public function __construct(
        private CreateClientService $createClientService,
        private GetAllClientService $getAllClientService,
        private GetOneClientService $getOneClientService,
        private UpdateClientService $updateClientService,
        private RemoveClientService $removeClientService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $records = $this->getAllClientService->execute();

        return response()->json(ClientResource::collection($records));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request): JsonResponse
    {
        $dto = new ClientDTO($request->all(), $request->file('file'));

        $record = $this->createClientService->execute($dto);

        return response()->json(
            new ClientResource($record),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $record = $this->getOneClientService->execute($id);

        return response()->json(
            new ClientResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, $id): JsonResponse
    {
        $dto = new ClientDTO($request->all(), $request->file('file'));

        $record = $this->updateClientService->execute($dto, $id);

        return response()->json(
            new ClientResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->removeClientService->execute($id);

        return response()->json(
            [],
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
