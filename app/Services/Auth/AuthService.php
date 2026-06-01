<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    private UserRepositoryInterface $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }
    public function register(array $data): array
    {
        // create user (password will be hashed via model cast or explicitly)
        $user = $this->users->create([
            'name' => $data['name'] ?? null,
            'email' => $data['email'],
            'password' => isset($data['password']) ? Hash::make($data['password']) : null,
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function login(string $email, string $password): array
    {
        $user = $this->users->findByEmail($email);

        if (! $user || ! Hash::check($password, $user->password)) {
            throw new \InvalidArgumentException('Invalid credentials');
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function logout(User $user): void
    {
        // revoke current access token if present, otherwise revoke all
        if ($user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
            return;
        }

        $user->tokens()->delete();
    }

    public function currentUser(User $user): User
    {
        return $user;
    }
}
