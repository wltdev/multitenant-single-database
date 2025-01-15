<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lead\StoreLeadRequest;
use App\Http\Requests\Lead\UpdateLeadRequest;
use App\Http\Resources\LeadResource;
use App\Repositories\Lead\LeadRepositoryInterface;
use App\Services\Leads\CreateLeadService;
use App\Services\Leads\DeleteLeadService;
use App\Services\Leads\GetAllLeadsService;
use App\Services\Leads\GetOneLeadService;
use App\Services\Leads\UpdateLeadService;
use Illuminate\Http\JsonResponse;

class LeadsController extends Controller
{
    private $repository;

    public function __construct(
        private CreateLeadService $createLeadService,
        private GetAllLeadsService $getAllLeadService,
        private GetOneLeadService $getOneLeadService,
        private UpdateLeadService $updateLeadService,
        private DeleteLeadService $deleteLeadService,
        LeadRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $records = $this->getAllLeadService->execute();

        return response()->json(LeadResource::collection($records));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeadRequest $request): JsonResponse
    {
        $record = $this->createLeadService->execute($request->validated());

        return response()->json(
            new LeadResource($record),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $record = $this->getOneLeadService->execute($id);

        return response()->json(
            new LeadResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeadRequest $request, $id): JsonResponse
    {
        $record = $this->updateLeadService->execute($request->validated(), $id);

        return response()->json(
            new LeadResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->deleteLeadService->execute($id);

        return response()->json(
            [],
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
