<?php declare(strict_types=1);

use SweetAlert2\Laravel\Swal;

test('Alert displays correctly after being set', function () {
    Swal::fire([
        'title' => 'Test Alert',
        'icon' => 'info',
    ]);

    // Verify session has the data before request
    expect(session()->has(Swal::SESSION_KEY))->toBeTrue();

    // Make request that renders the alert
    $response = $this->get('/');
    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"Test Alert","icon":"info"})', escape: false);
});

test('Alert data persists in session before rendering', function () {
    Swal::success([
        'title' => 'Success!',
        'text' => 'Data persists until pulled',
    ]);

    // Verify session has the data
    expect(session()->has(Swal::SESSION_KEY))->toBeTrue();
    
    // The data remains in session and can be retrieved with get()
    // This is different from flash() which would be consumed on next request
    expect(session()->get(Swal::SESSION_KEY))->toBe([
        'title' => 'Success!',
        'text' => 'Data persists until pulled',
        'icon' => 'success',
    ]);
    
    // Data is still there after getting it (not pulled yet)
    expect(session()->has(Swal::SESSION_KEY))->toBeTrue();
    
    // Now when we render the view, it displays the alert
    $response = $this->get('/');
    $response
        ->assertStatus(200)
        ->assertSee('Swal.fire({"title":"Success!","text":"Data persists until pulled","icon":"success"})', escape: false);
});
