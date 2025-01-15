<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KanbanBoardColumnResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kanban_board_id' => $this->kanban_board_id,
            'kanban_board' => $this->kanbanBoard,
            'name' => $this->name,
            'order' => $this->order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
