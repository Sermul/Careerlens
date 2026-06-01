<?php

namespace App\Services\JobDescription;

use App\Models\JobDescription;
use App\Repositories\Contracts\JobDescriptionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class JobDescriptionService implements JobDescriptionServiceInterface
{
    private JobDescriptionRepositoryInterface $repository;

    public function __construct(JobDescriptionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data): JobDescription
    {
        return $this->repository->create([
            'id' => Str::uuid()->toString(),
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'metadata' => $data['metadata'] ?? null,
        ]);
    }

    public function update(string $id, array $data, string $userId): JobDescription
    {
        $jobDescription = $this->get($id, $userId);

        return $this->repository->update($jobDescription, [
            'title' => $data['title'] ?? $jobDescription->title,
            'content' => $data['content'] ?? $jobDescription->content,
            'metadata' => array_key_exists('metadata', $data) ? $data['metadata'] : $jobDescription->metadata,
        ]);
    }

    public function delete(string $id, string $userId): void
    {
        $jobDescription = $this->get($id, $userId);
        $this->repository->delete($jobDescription);
    }

    public function get(string $id, string $userId): JobDescription
    {
        $jobDescription = $this->repository->findById($id);

        if (! $jobDescription || $jobDescription->user_id !== $userId) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }

        return $jobDescription;
    }

    public function list(string $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->listByUser($userId, $perPage);
    }
}
