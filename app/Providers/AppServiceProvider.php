<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Idea;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Route::middleware('web')->group(base_path('routes/web.php'))->group(base_path('routes/auth.php'));

        Gate::define('admin', function(User $user): bool{
            return (bool) $user->is_admin;
        });
        //cache()->forget('topUsers');
        $topUsers = Cache::remember('topUsers', now()->addMinutes(5), function() {
        return User::withCount('ideas')->orderBy('created_at','DESC')->take(10)->get();
        });

        View::share('topUsers', $topUsers);

    }
}
