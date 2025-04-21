<?php

namespace SweetAlert2\Laravel;

use Illuminate\Support\ServiceProvider;

class SweetAlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/sweetalert2'),
        ]);
    }
}
