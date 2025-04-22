<?php declare(strict_types=1);

namespace SweetAlert2\Laravel;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'sweetalert2');
    }
}
