<?php

namespace SweetAlert2\Laravel;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/'),
        ]);
    }
}
