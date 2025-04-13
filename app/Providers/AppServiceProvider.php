<?php

namespace App\Providers;

use App\Models\User;
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
        Gate::define('customer', function(User $user){
            return $user->role === 'Customer';
        });
        Gate::define('merchant', function(User $user){
            return $user->role === 'Merchant';
        });
    }
}
