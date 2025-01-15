<?php

namespace App\Http\Controllers;

use App\Http\Requests\KanbanBoardColumn\StoreKanbanBoardColumnRequest;
use App\Http\Requests\KanbanBoardColumn\UpdateKanbanBoardColumnRequest;
use App\Http\Resources\KanbanBoardColumnResource;
use App\Services\KanbanBoardColumns\CreateKanbanBoardColumnService;
use App\Services\KanbanBoardColumns\GetAllKanbanBoardColumnService;
use App\Services\KanbanBoardColumns\GetOneKanbanBoardColumnService;
use App\Services\KanbanBoardColumns\RemoveKanbanBoardColumnService;
use App\Services\KanbanBoardColumns\ReorderKanbanBoardColumnCardsService;
use App\Services\KanbanBoardColumns\UpdateKanbanBoardColumnService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class KanbanBoardColumnsController extends Controller
{
    public function __construct(
        private CreateKanbanBoardColumnService $createKanbanBoardColumnService,
        private GetAllKanbanBoardColumnService $getAllKanbanBoardColumnService,
        private GetOneKanbanBoardColumnService $getOneKanbanBoardColumnService,
        private UpdateKanbanBoardColumnService $updateKanbanBoardColumnService,
        private RemoveKanbanBoardColumnService $removeKanbanBoardColumnService,
        private ReorderKanbanBoardColumnCardsService $reorderKanbanBoardColumnCardsService
    ) {}


    /**
     * @OA\Get(
     *     path="/kanban-board-columns",
     *     tags={"Kanban Boards Columns"},
     *     summary="Get list of kanban boards",
     *     @OA\Response(
     *         response=200,
     *         description="A list of kanban boards",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/KanbanBoardColumnResponse"))
     *     )
     * )
     *
     */
    public function index(): JsonResponse
    {
        $records = $this->getAllKanbanBoardColumnService->execute();

        return response()->json(KanbanBoardColumnResource::collection($records));
    }

    /**
     * @OA\Post(
     *     path="/kanban-board-columns",
     *     tags={"Kanban Boards Columns"},
     *     summary="Create new kanban board",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/KanbanBoardColumnRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="KanbanBoardColumn created",
     *         @OA\JsonContent(ref="#/components/schemas/KanbanBoardColumnResponse")
     *     )
     * )
     *
     */
    public function store(StoreKanbanBoardColumnRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $record = $this->createKanbanBoardColumnService->execute($payload);
        $record->syncPermissions($request->validated()['permissions']);

        return response()->json(
            new KanbanBoardColumnResource($record),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     *  @OA\Get(
     *     path="/kanban-board-columns/{id}",
     *     tags={"Kanban Boards Columns"},
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
     *         @OA\JsonContent(ref="#/components/schemas/KanbanBoardColumnResponse")
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $record = $this->getOneKanbanBoardColumnService->execute($id);

        return response()->json(
            new KanbanBoardColumnResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @OA\Put(
     *     path="/kanban-board-columns/{id}",
     *     tags={"Kanban Boards Columns"},
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
     *         @OA\JsonContent(ref="#/components/schemas/KanbanBoardColumnRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Board updated",
     *         @OA\JsonContent(ref="#/components/schemas/KanbanBoardColumnResponse")
     *     )
     * )
     *
     */
    public function update(UpdateKanbanBoardColumnRequest $request, $id): JsonResponse
    {
        $payload = $request->validated();
        $record = $this->updateKanbanBoardColumnService->execute($payload, $id);

        return response()->json(
            new KanbanBoardColumnResource($record),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @OA\Delete(
     *     path="/kanban-board-columns/{id}",
     *     tags={"Kanban Boards Columns"},
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
        $this->removeKanbanBoardColumnService->execute($id);

        return response()->json(
            [],
            JsonResponse::HTTP_NO_CONTENT
        );
    }

    public function reorderColumnsCards(Request $request): JsonResponse
    {
        $columns = $request->get('columns');
        $this->reorderKanbanBoardColumnCardsService->execute($columns);

        return response()->json(
            [],
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
