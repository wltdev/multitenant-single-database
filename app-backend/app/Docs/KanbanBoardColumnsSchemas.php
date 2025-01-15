<?php

namespace App\Docs;


/**
 * @OA\Schema(
 *     schema="KanbanBoardColumnRequest",
 *     type="object",
 *     @OA\Property(
 *         property="kanban_board_id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="order",
 *         type="integer"
 *     ),
 * )
 *
 * @OA\Schema(
 *     schema="KanbanBoardColumnResponse",
 *     type="object",
 *     @OA\Property(
 *         property="kanban_board_id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="order",
 *         type="integer"
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
 */
class KanbanBoardColumnsSchemas {}
