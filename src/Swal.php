<?php declare(strict_types=1);

namespace SweetAlert2\Laravel;

class Swal
{
    /**
     * @param  array{title?: string, html?: string, icon?: string, confirmButtonText?: string}  $options
     */
    public static function fire(array $options = []): void
    {
        session()->flash('sweetalert2', $options);
    }
}
