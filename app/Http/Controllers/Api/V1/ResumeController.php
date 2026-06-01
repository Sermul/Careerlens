<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\UploadResumeRequest;
use App\Http\Resources\Api\V1\ResumeResource;
use App\Services\Resume\ResumeServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    private ResumeServiceInterface $resumeService;

    public function __construct(ResumeServiceInterface $resumeService)
    {
        $this->resumeService = $resumeService;
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 15);
        $resumes = $this->resumeService->list($request->user()->id, $perPage);

        return response()->json(ResumeResource::collection($resumes));
    }

    public function store(UploadResumeRequest $request): JsonResponse
    {
        $payload = $request->validated();
        $payload['user_id'] = $request->user()->id;
        $resume = $this->resumeService->upload($payload);

        return response()->json(new ResumeResource($resume), 201);
    }

    public function show(string $id, Request $request): JsonResponse
    {
        $resume = $this->resumeService->get($id, $request->user()->id);

        return response()->json(new ResumeResource($resume));
    }

    public function update(string $id, Request $request): JsonResponse
    {
        return response()->json(['message' => 'Update is not supported for resume uploads.'], 405);
    }

    public function destroy(string $id, Request $request): JsonResponse
    {
        $this->resumeService->delete($id, $request->user()->id);

        return response()->json(null, 204);
    }

    public function history(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 15);
        $resumes = $this->resumeService->history($request->user()->id, $perPage);

        return response()->json(ResumeResource::collection($resumes));
    }
}
