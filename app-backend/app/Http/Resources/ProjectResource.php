<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'company_id' => $this->company_id,
            'title' => $this->title,
            'description' => $this->description,
            'client_id' => $this->client_id,
            'client' => $this->client,
            'begin_date' => $this->begin_date,
            'due_date' => $this->due_date,

            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'members' => ProjectMemberResource::collection($this->members) ?? [],
            'files' => $this->getMedia('project_files')->toArray(),
        ];
    }
}
