<?php

namespace App\Repositories\Eloquent;

use App\Models\JobDescription;
use App\Repositories\Contracts\JobDescriptionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class JobDescriptionRepository implements JobDescriptionRepositoryInterface
{
    public function create(array $data): JobDescription
    {
        return JobDescription::create($data);
    }

    public function update(JobDescription $jobDescription, array $data): JobDescription
    {
        $jobDescription->fill($data);
        $jobDescription->save();

        return $jobDescription;
    }

    public function findById(string $id): ?JobDescription
    {
        return JobDescription::find($id);
    }

    public function listByUser(string $userId, int $perPage = 15): LengthAwarePaginator
    {
        return JobDescription::query()
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function delete(JobDescription $jobDescription): void
    {
        $jobDescription->delete();
    }
}
