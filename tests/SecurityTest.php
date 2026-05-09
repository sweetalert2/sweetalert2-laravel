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

test('Swal::fire() does not render non-function callback strings as executable code', function () {
    Swal::fire([
        'title' => 'Invalid callback should stay string',
        'didOpen' => 'alert("XSS")',
    ]);

    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('"didOpen":"alert(\"XSS\")"', escape: false)
        ->assertDontSee('"didOpen": alert("XSS")', escape: false);
});

test('Swal::renderFireCall() keeps non-function callback strings JSON encoded', function () {
    $result = Swal::renderFireCall([
        'didOpen' => 'alert("XSS")',
    ]);

    expect($result)
        ->toContain('"didOpen":"alert(\"XSS\")"')
        ->not->toContain('"didOpen": alert("XSS")');
});

test('Swal::renderFireCall() handles invalid UTF-8 in regular options', function () {
    $result = Swal::renderFireCall([
        'title' => "\xB11",
    ]);

    expect($result)
        ->toContain('Swal.fire({"title":"\ufffd1"})');
});
