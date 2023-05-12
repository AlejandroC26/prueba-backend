<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateResource extends JsonResource
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
			'name' => $this->name,
			'source' => $this->source,
			'owner' => $this->owner,
			'created_at' => date_format(date_create($this->created_at), 'Y-m-d H:i:s a'),
			'created_by' => $this->created_by,
        ];
    }
}
