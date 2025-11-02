<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    protected function configureRateLimiting(): void
{
    // Default API limiter
    RateLimiter::for('api', function (Request $request) {
        if (app()->environment('local')) {
            // Super loose while developing
            return [ Limit::perMinute(6000)->by($request->ip()) ];
        }
        // Your normal default in prod
        return [ Limit::perMinute(60)->by($request->ip()) ];
    });

    // Your custom limiter for lab inbox
    RateLimiter::for('labresults', function (Request $request) {
        $key = $request->header('X-API-Key') ?: $request->ip();
        if (app()->environment('local')) {
            return [ Limit::perMinute(6000)->by($key) ];
        }
        return [ Limit::perMinute(120)->by($key) ];
    });
}
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
