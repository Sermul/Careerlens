<?php

namespace App\Services\JobDescription;

use App\Models\JobDescription;

interface JobDescriptionServiceInterface
{
    public function create(array $data): JobDescription;

    public function update(string $id, array $data, string $userId): JobDescription;

    public function delete(string $id, string $userId): void;

    public function get(string $id, string $userId): JobDescription;

    public function list(string $userId, int $perPage = 15);
}
