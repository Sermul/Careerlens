<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ResumeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => (string) $this->id,
            'title' => $this->title,
            'filename' => $this->filename,
            'size_bytes' => $this->size_bytes,
            'version' => $this->version,
            'uploaded_at' => optional($this->uploaded_at)->toDateTimeString(),
            'deleted_at' => optional($this->deleted_at)->toDateTimeString(),
            'metadata' => $this->metadata,
            'storage_path' => $this->storage_path,
        ];
    }
}
