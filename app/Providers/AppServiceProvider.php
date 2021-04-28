<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\InvitationObserver;
use App\Observers\UserObserver;
use App\Models\Invitation;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Invitation::observe(InvitationObserver::class);
        User::observe(UserObserver::class);
    }
}
