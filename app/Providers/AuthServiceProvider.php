<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensCan([
            'admin'    => 'Access Admin Backend',
            'talent'   => 'Access Talent App',
            'business' => 'Access Business App',
        ]);
    
        Passport::setDefaultScope([ 'talent' ]);

        ResetPassword::createUrlUsing(function ($user, string $token) {
            return url("reset-password?token={$token}");
        });
    }
}
