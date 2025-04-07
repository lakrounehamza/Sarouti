<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\AuthRepositoryInterface;
use App\repositorys\AuthRepository;
use App\Contracts\AnnonceRepositoryInterface;
use App\Contracts\ImageAnnonceRepositoryInterface;
use App\repositorys\ImageAnnonceRepository;
use App\repositorys\AnnonceRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(AnnonceRepositoryInterface::class, AnnonceRepository::class);
        $this->app->bind(ImageAnnonceRepositoryInterface::class, ImageAnnonceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
