<?php declare(strict_types=1);

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use SweetAlert2\Laravel\Events\SweetAlert2BroadcastEvent;
use SweetAlert2\Laravel\Swal;

/* --------------------------------------------------------------------------
 * SweetAlert2BroadcastEvent class tests
 * -------------------------------------------------------------------------- */

test('SweetAlert2BroadcastEvent::broadcastOn() returns a public Channel', function () {
    $event = new SweetAlert2BroadcastEvent('my-channel', ['title' => 'Hello']);

    $channel = $event->broadcastOn();

    expect($channel)->toBeInstanceOf(Channel::class);
    expect($channel->name)->toBe('my-channel');
});

test('SweetAlert2BroadcastEvent::broadcastOn() returns a PrivateChannel when private is true', function () {
    $event = new SweetAlert2BroadcastEvent('user.1', ['title' => 'Hello'], private: true);

    $channel = $event->broadcastOn();

    expect($channel)->toBeInstanceOf(PrivateChannel::class);
});

test('SweetAlert2BroadcastEvent::broadcastAs() returns the session key', function () {
    $event = new SweetAlert2BroadcastEvent('my-channel', ['title' => 'Hello']);

    expect($event->broadcastAs())->toBe(Swal::SESSION_KEY);
});

test('SweetAlert2BroadcastEvent::broadcastWith() returns the options array', function () {
    $options = ['title' => 'Hello', 'icon' => 'success', 'toast' => true];
    $event = new SweetAlert2BroadcastEvent('my-channel', $options);

    expect($event->broadcastWith())->toBe($options);
});

/* --------------------------------------------------------------------------
 * Broadcast view template tests
 * -------------------------------------------------------------------------- */

test('broadcast view renders Echo channel listener for a public channel', function () {
    $rendered = view('sweetalert2::broadcast', ['channel' => 'my-channel'])->render();

    expect($rendered)
        ->toContain('window.Echo')
        ->toContain('"my-channel"')
        ->toContain('.' . Swal::SESSION_KEY);
});

test('broadcast view uses window.Echo.channel() for a public channel', function () {
    $rendered = view('sweetalert2::broadcast', ['channel' => 'announcements'])->render();

    expect($rendered)
        ->toContain('window.Echo.channel("announcements")')
        ->not->toContain('window.Echo.private');
});

test('broadcast view uses window.Echo.private() for a private channel', function () {
    $rendered = view('sweetalert2::broadcast', ['channel' => 'user.1', 'private' => true])->render();

    expect($rendered)
        ->toContain('window.Echo.private("user.1")')
        ->not->toContain('window.Echo.channel');
});

test('broadcast view defaults to public channel when private is not set', function () {
    $rendered = view('sweetalert2::broadcast', ['channel' => 'general'])->render();

    expect($rendered)->toContain('window.Echo.channel("general")');
});

test('broadcast view includes callback validation', function () {
    $rendered = view('sweetalert2::broadcast', ['channel' => 'my-channel'])->render();

    expect($rendered)->toContain('isValidCallback');
});

test('broadcast view includes SweetAlert2 CDN loader', function () {
    $rendered = view('sweetalert2::broadcast', ['channel' => 'my-channel'])->render();

    expect($rendered)->toContain('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.esm.all.min.js');
});

/* --------------------------------------------------------------------------
 * Swal shortcut method options tests
 * -------------------------------------------------------------------------- */

test('Swal::broadcastSuccess() builds event options with success icon', function () {
    $event = new SweetAlert2BroadcastEvent('channel', ['title' => 'Done!', 'icon' => 'success']);

    expect($event->broadcastWith())->toMatchArray(['icon' => 'success']);
});

test('Swal::broadcastToastSuccess() builds event options with toast and success icon', function () {
    $event = new SweetAlert2BroadcastEvent('channel', ['title' => 'Done!', 'toast' => true, 'icon' => 'success']);

    expect($event->broadcastWith())->toMatchArray(['toast' => true, 'icon' => 'success']);
});

test('Swal::broadcastPrivate() creates event on a PrivateChannel', function () {
    $event = new SweetAlert2BroadcastEvent('user.42', ['title' => 'Hello'], private: true);

    expect($event->broadcastOn())->toBeInstanceOf(PrivateChannel::class);
    expect($event->broadcastWith())->toBe(['title' => 'Hello']);
});
