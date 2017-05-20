<?php

namespace App\Providers;

use App\Advert;
use App\Category;
use App\Policies\AdvertPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Advert::class => AdvertPolicy::class,
        Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param Gate $gate
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

//        Gate::define('delete-advert', function ($user, $advert) {
//            return $user->id == $advert->user_id;
//        });

    }
}
