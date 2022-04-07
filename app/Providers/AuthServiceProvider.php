<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Auth\Access\Response;

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

        Gate::define('hasPermission', function(User $user, $permission = '') {
            return $user->hasPermission($permission)
            ? Response::allow()
            : Response::deny('No tiene privilegios para esta acción');
        });

        Gate::define('hasRole', function(User $user, $slug) {
            return $user->findRole($slug)
            ? Response::allow()
            : Response::deny('Esta vista no le es permitida');
        });

        Gate::define('justFor', function(User $user, array $slugs) {
            $canAccess = false;
            // $slugs = [$one, $two, $tree];
            foreach ($slugs as $slug) {
                if($user->findRole($slug)){
                    $canAccess = true;
                }
            };
            return $canAccess
            ? Response::allow()
            : Response::deny('Esta vista no le es permitida');
        });
        Gate::define('only',function(User $user,string $slugs){
            $canAccess = false;
            $slugsArray = explode('|',$slugs);
            foreach ($slugsArray as $slug) {
                if($user->findRole($slug)){
                    $canAccess = true;
                }
            };
            return $canAccess
            ? Response::allow()
            : Response::deny('Esta vista no le es permitida');
        });
    }
}
