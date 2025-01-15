<?php
// app/Docs/KanbanBoardSchemas.php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="KanbanBoardRequest",
 *     type="object",
 *     @OA\Property(
 *         property="type",
 *         type="string",
 *         example="lead"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="Lead Board"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         example="Lead Kanban Board"
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="KanbanBoardResponse",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=3
 *     ),
 *     @OA\Property(
 *         property="type",
 *         type="string",
 *         example="lead"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="Lead Board"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         example="Lead Kanban Board"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2024-11-06T22:21:57.000000Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2024-11-06T22:21:57.000000Z"
 *     ),
 *     @OA\Property(
 *         property="columns",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/KanbanColumn")
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="KanbanColumn",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="kanban_board_id",
 *         type="integer",
 *         example=3
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="A Fazer"
 *     ),
 *     @OA\Property(
 *         property="order",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         nullable=true,
 *         format="date-time"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         nullable=true,
 *         format="date-time"
 *     ),
 *     @OA\Property(
 *         property="cards",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/KanbanCard")
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="KanbanCard",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="kanban_board_column_id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="company_id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         example="task 1 do a fazer"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         example="testando"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         example="new"
 *     ),
 *     @OA\Property(
 *         property="budget",
 *         type="string",
 *         example="200.00"
 *     ),
 *     @OA\Property(
 *         property="priority",
 *         type="string",
 *         example="medium"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         nullable=true,
 *         format="date-time"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         nullable=true,
 *         format="date-time"
 *     )
 * )
 */
class KanbanBoardSchemas {}
