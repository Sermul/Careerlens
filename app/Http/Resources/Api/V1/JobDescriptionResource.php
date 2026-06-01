<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class JobDescriptionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => (string) $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'metadata' => $this->metadata,
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
