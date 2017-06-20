<?php

namespace QMagico\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'QMagico\Model' => 'QMagico\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $gate->before(function($user, $ability)
        {
            if($user->group->name == 'Administrador') {
                return true;
            }
        });

        $gate->define('answer', function ($user, $answer) {
            return $user->id == $answer->user_id;
        });
    }
}
