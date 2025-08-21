<?php declare(strict_types=1);

namespace SweetAlert2\Laravel;

/**
 * Laravel SweetAlert2 Integration Service Provider {@see https://github.com/sweetalert2/sweetalert2-laravel}
 * @package SweetAlert2\Laravel
 * @see https://sweetalert2.github.io
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /*
     * Bootstrap the package services
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'sweetalert2');
    }
}
