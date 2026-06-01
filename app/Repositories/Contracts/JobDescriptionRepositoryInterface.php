<?php

namespace App\Repositories\Contracts;

use App\Models\JobDescription;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface JobDescriptionRepositoryInterface
{
    public function create(array $data): JobDescription;

    public function update(JobDescription $jobDescription, array $data): JobDescription;

    public function findById(string $id): ?JobDescription;

    public function listByUser(string $userId, int $perPage = 15): LengthAwarePaginator;

    public function delete(JobDescription $jobDescription): void;
}
