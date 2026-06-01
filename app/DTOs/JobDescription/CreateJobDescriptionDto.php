<?php

namespace App\DTOs\JobDescription;

final class CreateJobDescriptionDto
{
    public function __construct(
        public string $userId,
        public string $title,
        public string $content,
        public ?array $metadata = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['user_id'],
            $data['title'],
            $data['content'],
            $data['metadata'] ?? null,
        );
    }
}
