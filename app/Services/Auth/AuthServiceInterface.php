<?php

namespace App\Services\Auth;

use App\Models\User;

interface AuthServiceInterface
{
    /**
     * Register a user and return user + token
     * @return array{user: User, token: string}
     */
    public function register(array $data): array;

    /**
     * Login and return user + token
     * @return array{user: User, token: string}
     */
    public function login(string $email, string $password): array;

    public function logout(User $user): void;

    public function currentUser(User $user): User;
}
