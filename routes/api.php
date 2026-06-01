<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ResumeController;

Route::prefix('api/v1')->group(function () {
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::post('auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('auth/logout', [AuthController::class, 'logout']);
        Route::get('auth/me', [AuthController::class, 'me']);

        Route::get('resumes', [ResumeController::class, 'index']);
        Route::post('resumes', [ResumeController::class, 'store']);
        Route::get('resumes/{id}', [ResumeController::class, 'show']);
        Route::delete('resumes/{id}', [ResumeController::class, 'destroy']);
        Route::get('resumes/history', [ResumeController::class, 'history']);
    });
});
