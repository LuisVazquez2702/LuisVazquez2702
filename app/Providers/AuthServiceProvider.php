<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
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

        Gate::define('mostrarAdminUser', function(User $user){
            if($user->tipo_usuario==1 && $user->id==1){
                return true;
            }else{
                return false;
            }
        });

        GATE::define('mostrarAdmin', function(User $user){
            if($user->tipo_usuario==1){
                return true;
            }else{
                return false;
            }
        });
        GATE::define('mostarAdmin&Negocio', function(User $user){
            if($user->tipo_usuario==1 || $user->tipo_usuario==2){
                return true;
            }else{
                return false;
            }
        });
        GATE::define('mostarNegocio', function(User $user){
            if($user->tipo_usuario==2){
                return true;
            }else{
                return false;
            }
        });
        //
    }
}
