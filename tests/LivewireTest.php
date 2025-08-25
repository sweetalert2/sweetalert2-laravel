<?php declare(strict_types=1);

test('Livewire', function () {
    visit('/')
        ->click('Increment')
        ->assertSee('1')
        ->assertSee('Count is 1');
});
