<?php

namespace App\DTOs\Auth;

final class RegisterUserDto
{
    public function __construct(public string $name, public string $email, public string $password)
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'] ?? '',
            $data['email'],
            $data['password']
        );
    }
}
