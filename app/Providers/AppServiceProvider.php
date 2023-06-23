<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Financial;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('all-users', function ($user) {
            return $user->getRole() === 'admin';
        });

        Gate::define('edit-user', function ($user) {
            return $user->getRole() === 'admin' || $user->getRole() === 'financial_level_1';
        });

        Gate::define('delete-user', function ($user) {
            return $user->getRole() === 'admin' || $user->getRole() === 'financial_level_2';
        });
    }
}
