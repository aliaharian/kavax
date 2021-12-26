<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* define a admin user role */
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });

        /* define All User role */
        Gate::define('isManager', function($user) {
            return $user->role == 'admin' || $user->role == 'author' || $user->role == 'manager';
        });

        /* define a author user role */
        Gate::define('isAuthor', function($user) {
            return $user->role == 'admin' || $user->role == 'author';
        });

        /* define a user role */
        Gate::define('isUser', function($user) {
            return $user->role == 'admin' || $user->role == 'user';
        });
    }
}
