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
            __DIR__.'/../resources/views' => resource_path('views/vendor/sweetalert2'),
        ], 'sweetalert2');
    }
}
