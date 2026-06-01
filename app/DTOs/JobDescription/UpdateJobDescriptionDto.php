<?php

namespace App\DTOs\JobDescription;

final class UpdateJobDescriptionDto
{
    public function __construct(
        public string $title,
        public string $content,
        public ?array $metadata = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'],
            $data['content'],
            $data['metadata'] ?? null,
        );
    }
}
