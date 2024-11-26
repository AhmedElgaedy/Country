<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The namespace that should be applied to your controllers.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for your application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapSoapRoutes();
        $this->mapWebhookRoutes();
    }
    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes are typically stateful.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "soap" routes for the application.
     *
     * @return void
     */
    protected function mapSoapRoutes()
    {
        Route::prefix('api/soap')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/soap.php'));
    }

    /**
     * Define the "webhook" routes for the application.
     *
     * @return void
     */
    protected function mapWebhookRoutes()
    {
        Route::prefix('webhooks')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/webhooks.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * @return void
     */

}
