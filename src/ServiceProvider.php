<?php declare(strict_types=1);

namespace SweetAlert2\Laravel;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Copy the package vendor files.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/'),
            __DIR__.'/../resources/js' => resource_path('js/vendor/'),
        ], 'sweetalert2');
    }

    /**
     * Register the package facade.
     */
    public function register(): void
    {
        $this->app->singleton('sweetalert2', function ($app) {
            return $this->app->make(SweetAlert2::class);
        });
    }

}
