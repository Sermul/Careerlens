<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ResumeRepositoryInterface;
use App\Models\Resume;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ResumeRepository implements ResumeRepositoryInterface
{
    public function create(array $data): Resume
    {
        return Resume::create($data);
    }

    public function update(Resume $resume, array $data): Resume
    {
        $resume->fill($data);
        $resume->save();

        return $resume;
    }

    public function findById(string $id): ?Resume
    {
        return Resume::find($id);
    }

    public function listByUser(string $userId, int $perPage = 15): LengthAwarePaginator
    {
        return Resume::query()
            ->where('user_id', $userId)
            ->orderByDesc('uploaded_at')
            ->paginate($perPage);
    }

    public function listHistoryByUser(string $userId, int $perPage = 15): LengthAwarePaginator
    {
        return Resume::withTrashed()
            ->where('user_id', $userId)
            ->orderByDesc('uploaded_at')
            ->paginate($perPage);
    }

    public function delete(Resume $resume): void
    {
        $resume->delete();
    }
}
