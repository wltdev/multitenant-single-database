<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Repositories\Company\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Companies
 */
class CompaniesController extends Controller
{
    private $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $records = $this->repository->getAll();

        return response()->json(CompanyResource::collection($records));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $record = $this->repository->store($request->all());

        return response()->json(
            new CompanyResource($record),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $record = $this->repository->find($id);

        return response()->json(
            new CompanyResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, $id): JsonResponse
    {
        $record = $this->repository->update($request->all(), $id);

        return response()->json(
            new CompanyResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
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
