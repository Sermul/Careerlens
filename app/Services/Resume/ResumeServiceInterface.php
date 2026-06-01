<?php

namespace App\Services\Resume;

use App\Models\Resume;

interface ResumeServiceInterface
{
    public function upload(array $data): Resume;

    public function list(string $userId, int $perPage = 15): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    public function history(string $userId, int $perPage = 15): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    public function get(string $id, string $userId): Resume;

    public function delete(string $id, string $userId): void;
}
