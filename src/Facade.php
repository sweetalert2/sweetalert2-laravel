<?php declare(strict_types=1);

namespace SweetAlert2\Laravel;

/**
 * @method static \SweetAlert2\Laravel\Swal fire(array $options = [])
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sweetalert2';
    }
}
