<?php declare(strict_types=1);

use SweetAlert2\Laravel\Swal;

test('Swal::fire()', function () {
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

test('Swal::success()', function () {
    Swal::success([
        'title' => 'success title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"icon":"success","title":"success title"})', escape: false);
});

test('Swal::error()', function () {
    Swal::error([
        'title' => 'error title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"icon":"error","title":"error title"})', escape: false);
});

test('Swal::warning()', function () {
    Swal::warning([
        'title' => 'warning title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"icon":"warning","title":"warning title"})', escape: false);
});

test('Swal::info()', function () {
    Swal::info([
        'title' => 'info title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"icon":"info","title":"info title"})', escape: false);
});

test('Swal::question()', function () {
    Swal::question([
        'title' => 'question title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"icon":"question","title":"question title"})', escape: false);
});

test('Swal::toast()', function () {
    Swal::toast([
        'title' => 'toast title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"toast":true,"title":"toast title"})', escape: false);
});

test('Swal::toastSuccess()', function () {
    Swal::toastSuccess([
        'title' => 'toast success title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"toast":true,"icon":"success","title":"toast success title"})', escape: false);
});

test('Swal::toastError()', function () {
    Swal::toastError([
        'title' => 'toast error title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"toast":true,"icon":"error","title":"toast error title"})', escape: false);
});

test('Swal::toastWarning()', function () {
    Swal::toastWarning([
        'title' => 'toast warning title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"toast":true,"icon":"warning","title":"toast warning title"})', escape: false);
});

test('Swal::toastInfo()', function () {
    Swal::toastInfo([
        'title' => 'toast info title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"toast":true,"icon":"info","title":"toast info title"})', escape: false);
});

test('Swal::toastQuestion()', function () {
    Swal::toastQuestion([
        'title' => 'toast question title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"toast":true,"icon":"question","title":"toast question title"})', escape: false);
});
