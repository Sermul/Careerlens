<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request): array
    {
        // resource is expected to be ['user' => User, 'token' => string]
        $user = $this->resource['user'] ?? null;
        $token = $this->resource['token'] ?? null;

        return [
            'user' => $user ? (new UserResource($user))->toArray($request) : null,
            'token' => $token,
        ];
    }
}
