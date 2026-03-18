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
        ->assertSee("await import('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.esm.all.min.js')).default", escape: false)
        ->assertSee('Swal.fire({"title":"SweetAlert2 + Laravel = \u003C3","text":"This is a simple alert using SweetAlert2","icon":"success","confirmButtonText":"Cool"})', escape: false);
});

test('Swal::success()', function () {
    Swal::success([
        'title' => 'success title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"success title","icon":"success"})', escape: false);
});

test('Swal::error()', function () {
    Swal::error([
        'title' => 'error title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"error title","icon":"error"})', escape: false);
});

test('Swal::warning()', function () {
    Swal::warning([
        'title' => 'warning title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"warning title","icon":"warning"})', escape: false);
});

test('Swal::info()', function () {
    Swal::info([
        'title' => 'info title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"info title","icon":"info"})', escape: false);
});

test('Swal::question()', function () {
    Swal::question([
        'title' => 'question title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"question title","icon":"question"})', escape: false);
});

test('Swal::toast()', function () {
    Swal::toast([
        'title' => 'toast title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"toast title","toast":true})', escape: false);
});

test('Swal::toastSuccess()', function () {
    Swal::toastSuccess([
        'title' => 'toast success title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"toast success title","toast":true,"icon":"success"})', escape: false);
});

test('Swal::toastError()', function () {
    Swal::toastError([
        'title' => 'toast error title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"toast error title","toast":true,"icon":"error"})', escape: false);
});

test('Swal::toastWarning()', function () {
    Swal::toastWarning([
        'title' => 'toast warning title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"toast warning title","toast":true,"icon":"warning"})', escape: false);
});

test('Swal::toastInfo()', function () {
    Swal::toastInfo([
        'title' => 'toast info title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"toast info title","toast":true,"icon":"info"})', escape: false);
});

test('Swal::toastQuestion()', function () {
    Swal::toastQuestion([
        'title' => 'toast question title',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"toast question title","toast":true,"icon":"question"})', escape: false);
});

test('Swal::fire() with didOpen callback', function () {
    Swal::fire([
        'title' => 'Toast with callbacks',
        'toast' => true,
        'position' => 'top-end',
        'didOpen' => '(toast) => { toast.onmouseenter = Swal.stopTimer; toast.onmouseleave = Swal.resumeTimer; }',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('"title": "Toast with callbacks"', escape: false)
        ->assertSee('"toast": true', escape: false)
        ->assertSee('"position": "top-end"', escape: false)
        ->assertSee('"didOpen": (toast) => { toast.onmouseenter = Swal.stopTimer; toast.onmouseleave = Swal.resumeTimer; }', escape: false);
});

test('Swal::fire() with multiple callbacks', function () {
    Swal::fire([
        'title' => 'Multiple callbacks',
        'icon' => 'info',
        'didOpen' => '() => { console.log("opened"); }',
        'willClose' => '() => { console.log("closing"); }',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('"didOpen": () => { console.log("opened"); }', escape: false)
        ->assertSee('"willClose": () => { console.log("closing"); }', escape: false);
});
