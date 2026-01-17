<?php declare(strict_types=1);

use SweetAlert2\Laravel\Swal;

test('Swal::fire() sanitizes closing script tags in callbacks', function () {
    Swal::fire([
        'title' => 'Test XSS Protection',
        'didOpen' => '() => { console.log("test"); }</script><script>alert("XSS")</script>',
    ]);

    $response = $this->get('/');

    // Should escape the closing script tag to prevent XSS
    $response
        ->assertStatus(200)
        ->assertSee('"didOpen": () => { console.log("test"); }<\/script><script>alert("XSS")<\/script>', escape: false)
        ->assertDontSee('</script><script>alert("XSS")</script>', escape: false);
});

test('Swal::fire() sanitizes closing style tags in callbacks', function () {
    Swal::fire([
        'title' => 'Test Style Tag Protection',
        'didOpen' => '() => { return true; }</style><script>alert("XSS")</script>',
    ]);

    $response = $this->get('/');

    // Should escape the closing style tag
    $response
        ->assertStatus(200)
        ->assertSee('"didOpen": () => { return true; }<\/style><script>alert("XSS")<\/script>', escape: false)
        ->assertDontSee('</style><script>alert("XSS")</script>', escape: false);
});

test('Swal::fire() escapes HTML entities in regular options', function () {
    Swal::fire([
        'title' => '<script>alert("XSS")</script>',
        'text' => '<img src=x onerror=alert("XSS")>',
    ]);

    $response = $this->get('/');

    // JSON_HEX_TAG should escape < and > in JSON strings
    $response
        ->assertStatus(200)
        ->assertSee('\u003Cscript\u003E', escape: false)
        ->assertDontSee('<script>', escape: false);
});

test('Swal::fire() handles case-insensitive script tags', function () {
    Swal::fire([
        'title' => 'Test Case Insensitive',
        'didOpen' => '() => { }</SCRIPT><SCRIPT>alert("XSS")</SCRIPT>',
    ]);

    $response = $this->get('/');

    // Should escape uppercase closing tags too
    $response
        ->assertStatus(200)
        ->assertSee('<\/SCRIPT>', escape: false)
        ->assertDontSee('</SCRIPT><SCRIPT>', escape: false);
});

test('Swal::renderFireCall() method sanitizes callbacks', function () {
    $result = Swal::renderFireCall([
        'title' => 'Test',
        'didOpen' => '() => { alert("test"); }</script><script>alert("XSS")',
    ]);

    expect($result)
        ->toContain('<\/script>')
        ->not->toContain('</script><script>alert("XSS")');
});
