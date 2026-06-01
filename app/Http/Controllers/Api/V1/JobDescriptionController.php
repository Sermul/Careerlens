<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JobDescriptionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function store(Request $request): JsonResponse
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function show(string $id, Request $request): JsonResponse
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function update(string $id, Request $request): JsonResponse
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function destroy(string $id, Request $request): JsonResponse
    {
        throw new \BadMethodCallException('Not implemented');
    }
}
