<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\ResumeRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\JobDescriptionRepositoryInterface;
use App\Repositories\Eloquent\ResumeRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\JobDescriptionRepository;
use App\Services\Auth\AuthServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Pdf\PdfParserServiceInterface;
use App\Services\Pdf\PdfParserService;
use App\Services\Resume\ResumeServiceInterface;
use App\Services\Resume\ResumeService;
use App\Services\JobDescription\JobDescriptionServiceInterface;
use App\Services\JobDescription\JobDescriptionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(ResumeRepositoryInterface::class, ResumeRepository::class);
        $this->app->bind(ResumeServiceInterface::class, ResumeService::class);
        $this->app->bind(PdfParserServiceInterface::class, PdfParserService::class);
        $this->app->bind(JobDescriptionRepositoryInterface::class, JobDescriptionRepository::class);
        $this->app->bind(JobDescriptionServiceInterface::class, JobDescriptionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
