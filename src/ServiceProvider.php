<?php declare(strict_types=1);

namespace SweetAlert2\Laravel;

use Inertia\Inertia;
use Livewire\Livewire;

/**
 * Laravel SweetAlert2 Integration {@see https://github.com/sweetalert2/sweetalert2-laravel}
 *
 * @see https://sweetalert2.github.io
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /*
     * Load views for the package.
     */
    public function boot(): void
    {
        if (class_exists(Livewire::class)) {
            $this->loadViewsFrom(__DIR__ . '/../resources/views/livewire', 'sweetalert2');
        } elseif (class_exists(Inertia::class)) {
            $this->loadViewsFrom(__DIR__ . '/../resources/views/inertia', 'sweetalert2');
        } else {
            $this->loadViewsFrom(__DIR__ . '/../resources/views/laravel', 'sweetalert2');
        }
    }
}
