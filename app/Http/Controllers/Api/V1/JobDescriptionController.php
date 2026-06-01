<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobDescription\StoreJobDescriptionRequest;
use App\Http\Requests\JobDescription\UpdateJobDescriptionRequest;
use App\Http\Resources\Api\V1\JobDescriptionResource;
use App\Services\JobDescription\JobDescriptionServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobDescriptionController extends Controller
{
    private JobDescriptionServiceInterface $service;

    public function __construct(JobDescriptionServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 15);
        $jobDescriptions = $this->service->list($request->user()->id, $perPage);

        return response()->json(JobDescriptionResource::collection($jobDescriptions));
    }

    public function store(StoreJobDescriptionRequest $request): JsonResponse
    {
        $payload = array_merge($request->validated(), ['user_id' => $request->user()->id]);
        $jobDescription = $this->service->create($payload);

        return response()->json(new JobDescriptionResource($jobDescription), 201);
    }

    public function show(string $id, Request $request): JsonResponse
    {
        $jobDescription = $this->service->get($id, $request->user()->id);

        return response()->json(new JobDescriptionResource($jobDescription));
    }

    public function update(string $id, UpdateJobDescriptionRequest $request): JsonResponse
    {
        $jobDescription = $this->service->update($id, $request->validated(), $request->user()->id);

        return response()->json(new JobDescriptionResource($jobDescription));
    }

    public function destroy(string $id, Request $request): JsonResponse
    {
        $this->service->delete($id, $request->user()->id);

        return response()->json(null, 204);
    }
}
