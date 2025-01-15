<?php

namespace App\Http\Controllers;

use App\Http\Requests\KanbanBoard\StoreKanbanBoardRequest;
use App\Http\Requests\KanbanBoard\UpdateKanbanBoardRequest;
use App\Http\Resources\KanbanBoardResource;
use App\Services\KanbanBoards\CreateKanbanBoardService;
use App\Services\KanbanBoards\GetAllKanbanBoardService;
use App\Services\KanbanBoards\GetOneKanbanBoardService;
use App\Services\KanbanBoards\RemoveKanbanBoardService;
use App\Services\KanbanBoards\UpdateKanbanBoardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KanbanBoardsController extends Controller
{
    public function __construct(
        private CreateKanbanBoardService $createKanbanBoardService,
        private GetAllKanbanBoardService $getAllKanbanBoardService,
        private GetOneKanbanBoardService $getOneKanbanBoardService,
        private UpdateKanbanBoardService $updateKanbanBoardService,
        private RemoveKanbanBoardService $removeKanbanBoardService
    ) {}


    /**
     * @OA\Get(
     *     path="/kanban-boards",
     *     tags={"Kanban Boards"},
     *     summary="Get list of kanban boards",
     *     @OA\Response(
     *         response=200,
     *         description="A list of kanban boards",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/KanbanBoardResponse"))
     *     )
     * )
     *
     */
    public function index(): JsonResponse
    {
        $records = $this->getAllKanbanBoardService->execute();

        return response()->json(KanbanBoardResource::collection($records));
    }

    /**
     * @OA\Post(
     *     path="/kanban-boards",
     *     tags={"Kanban Boards"},
     *     summary="Create new kanban board",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/KanbanBoardRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="KanbanBoard created",
     *         @OA\JsonContent(ref="#/components/schemas/KanbanBoardResponse")
     *     )
     * )
     *
     */
    public function store(StoreKanbanBoardRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $record = $this->createKanbanBoardService->execute($payload);

        return response()->json(
            new KanbanBoardResource($record),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     *  @OA\Get(
     *     path="/kanban-boards/{id}",
     *     tags={"Kanban Boards"},
     *     summary="Get single Board",
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
     *         description="A single Board",
     *         @OA\JsonContent(ref="#/components/schemas/KanbanBoardResponse")
     *     )
     * )
     */
    public function show(Request $request, $id): JsonResponse
    {
        $type = $request->query('type');
        $record = $this->getOneKanbanBoardService->execute($id, $type);

        return response()->json(
            $record,
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @OA\Put(
     *     path="/kanban-boards/{id}",
     *     tags={"Kanban Boards"},
     *     summary="Update board",
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
     *         @OA\JsonContent(ref="#/components/schemas/KanbanBoardRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Board updated",
     *         @OA\JsonContent(ref="#/components/schemas/KanbanBoardResponse")
     *     )
     * )
     *
     */
    public function update(UpdateKanbanBoardRequest $request, $id): JsonResponse
    {
        $payload = $request->validated();
        $record = $this->updateKanbanBoardService->execute($payload, $id);

        return response()->json(
            new KanbanBoardResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @OA\Delete(
     *     path="/kanban-boards/{id}",
     *     tags={"Kanban Boards"},
     *     summary="Delete Board",
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
     *         description="Board deleted"
     *     )
     * )
     */
    public function destroy($id)
    {
        $this->removeKanbanBoardService->execute($id);

        return response()->json(
            [],
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
