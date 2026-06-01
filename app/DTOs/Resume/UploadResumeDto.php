<?php

namespace App\DTOs\Resume;

use Illuminate\Http\UploadedFile;

final class UploadResumeDto
{
    public function __construct(
        public string $userId,
        public UploadedFile $resume,
        public ?string $title = null,
        public int $version = 1,
    ) {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            $data['user_id'],
            $data['resume'],
            $data['title'] ?? null,
            $data['version'] ?? 1,
        );
    }
}
