<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\ResumeRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\ResumeRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Auth\AuthServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Resume\ResumeServiceInterface;
use App\Services\Resume\ResumeService;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
