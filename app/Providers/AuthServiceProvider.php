<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('view-post', function ($user,$post) {
                $friend =$user->friends->where('id',$post->user_id)->first();
                return $user->id === $post->user_id||$user->role->name==="admin"||$friend !==null ;
        });
        Gate::define('delete-post', function ($user, $post) {
                return $user->id === $post->user_id||$user->role->name==="admin";
        });
        Gate::define('update-post', function ($user, $post) {
                return $user->id === $post->user_id;
        });
        //
    }
}
