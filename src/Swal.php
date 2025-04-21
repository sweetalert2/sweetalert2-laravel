<?php declare(strict_types=1);

namespace SweetAlert2\Laravel;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \SweetAlert2\Laravel\Swal fire(array $options = [])
 */
class Swal extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sweetalert2';
    }
}
