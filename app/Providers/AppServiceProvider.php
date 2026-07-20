<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('manage-animals', function (User $user) {
            return true;
        });

        Gate::define('is-admin', function (User $user) {
            return $user->status === 'admin';
        });
    }
}
