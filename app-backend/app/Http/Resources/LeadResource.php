<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'budget' => $this->budget,
            'priority' => $this->priority,
            'kanban_board_column_id' => $this->kanban_board_column_id,
            'kanban_board_column_order' => $this->kanban_board_column_order,
            'notes' => $this->notes,
            'participants' => $this->participants,
            'status_history' => $this->statusHistory,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
