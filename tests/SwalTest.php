<?php declare(strict_types=1);

use SweetAlert2\Laravel\Swal;

test('Swal::fire() should work', function () {
    Swal::fire([
        'title' => 'SweetAlert2 + Laravel = <3',
        'text' => 'This is a simple alert using SweetAlert2',
        'icon' => 'success',
        'confirmButtonText' => 'Cool'
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee("import Swal from 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.esm.all.min.js'", escape: false)
        ->assertSee('Swal.fire({"title":"SweetAlert2 + Laravel = \u003C3","text":"This is a simple alert using SweetAlert2","icon":"success","confirmButtonText":"Cool"})', escape: false);
});
