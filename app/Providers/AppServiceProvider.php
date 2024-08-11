<?php

namespace App\Providers;

use App\Models\Profile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Policies\ProfilePolicy;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Profile::class, ProfilePolicy::class);
        Gate::policy(Post::class, PostPolicy::class);
    }
}
