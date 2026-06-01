<?php

namespace App\Services\Resume;

use App\Models\Resume;
use App\Repositories\Contracts\ResumeRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class ResumeService implements ResumeServiceInterface
{
    private ResumeRepositoryInterface $repository;

    public function __construct(ResumeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function upload(array $data): Resume
    {
        /** @var UploadedFile $file */
        $file = $data['resume'];
        $path = sprintf('resumes/%s', $data['user_id']);
        $filename = sprintf('%s.%s', Str::uuid()->toString(), $file->getClientOriginalExtension());
        $storagePath = $file->storeAs($path, $filename, 'local');

        $resume = $this->repository->create([
            'id' => Str::uuid()->toString(),
            'user_id' => $data['user_id'],
            'title' => $data['title'] ?? $file->getClientOriginalName(),
            'filename' => $file->getClientOriginalName(),
            'storage_path' => $storagePath,
            'size_bytes' => $file->getSize(),
            'metadata' => [
                'mime_type' => $file->getClientMimeType(),
                'original_name' => $file->getClientOriginalName(),
            ],
            'version' => $data['version'] ?? 1,
            'uploaded_at' => now(),
        ]);

        return $resume;
    }

    public function list(string $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->listByUser($userId, $perPage);
    }

    public function history(string $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->listHistoryByUser($userId, $perPage);
    }

    public function get(string $id, string $userId): Resume
    {
        $resume = $this->repository->findById($id);

        if (! $resume || $resume->user_id !== $userId) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }

        return $resume;
    }

    public function delete(string $id, string $userId): void
    {
        $resume = $this->get($id, $userId);
        Storage::disk('local')->delete($resume->storage_path);
        $this->repository->delete($resume);
    }
}
