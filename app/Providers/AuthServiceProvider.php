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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('admin', function ($user) {
            if ($user->rol == 'administrador') {
                return true;
            }
            return false;
        });
        Gate::define('funcionario', function ($user) {
            if ($user->rol == 'funcionario') {
                return true;
            }
            return false;
        });
        Gate::define('entidad', function ($user) {
            if ($user->rol == 'entidad') {
                return true;
            }
            return false;
        });
        Gate::define('emprendedor', function ($user) {
            if ($user->rol == 'emprendedor') {
                return true;
            }
            return false;
        });

        //
    }
}
