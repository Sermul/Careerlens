<?php

namespace App\Repositories\Contracts;

use App\Models\Resume;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ResumeRepositoryInterface
{
    public function create(array $data): Resume;

    public function update(Resume $resume, array $data): Resume;

    public function findById(string $id): ?Resume;

    public function listByUser(string $userId, int $perPage = 15): LengthAwarePaginator;

    public function listHistoryByUser(string $userId, int $perPage = 15): LengthAwarePaginator;

    public function delete(Resume $resume): void;
}
