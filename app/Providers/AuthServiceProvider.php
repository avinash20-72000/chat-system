<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\User'           => 'App\Policies\UserPolicy',
        'App\Models\Role'           => 'App\Policies\RolePolicy',
        'App\Models\Permission'     => 'App\Policies\PermissionPolicy',
        'App\Models\Module'         => 'App\Policies\ModulePolicy',
        'App\Models\Chat'           => 'App\Policies\ChatPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
