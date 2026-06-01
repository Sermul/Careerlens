<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Auth\AuthServiceInterface;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Api\V1\AuthResource;
use App\Http\Resources\Api\V1\UserResource;


class AuthController extends Controller
{
    private AuthServiceInterface $auth;

    public function __construct(AuthServiceInterface $auth)
    {
        $this->auth = $auth;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $payload = $request->validated();
        $result = $this->auth->register($payload);

        return response()->json((new AuthResource($result))->toArray($request), 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $payload = $request->validated();
        $result = $this->auth->login($payload['email'], $payload['password']);

        return response()->json((new AuthResource($result))->toArray($request));
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();
        $this->auth->logout($user);

        return response()->json(null, 204);
    }

    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json((new UserResource($user))->toArray($request));
    }
}
