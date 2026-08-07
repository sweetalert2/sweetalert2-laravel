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
 * Swal broadcast facade method tests
 *
 * These tests bind a lightweight recording broadcaster to verify that each
 * Swal::broadcast*() method dispatches a SweetAlert2BroadcastEvent with the
 * expected options and channel type.
 * -------------------------------------------------------------------------- */

/**
 * Binds a lightweight broadcaster to the container that captures the next
 * event() call on the given test instance ($this->capturedEvent).
 */
function bindRecordingBroadcaster(object $test): void
{
    app()->bind('Illuminate\Contracts\Broadcasting\Factory', function () use ($test) {
        // A no-op event dispatcher so PendingBroadcast::__destruct() does nothing real.
        $noOpDispatcher = new class implements \Illuminate\Contracts\Events\Dispatcher {
            public function listen($events, $listener = null) {}
            public function hasListeners($eventName) { return false; }
            public function subscribe($subscriber) {}
            public function until($event, $payload = []) { return null; }
            public function dispatch($event, $payload = [], $halt = false) { return null; }
            public function push($event, $payload = []) {}
            public function flush($event) {}
            public function forget($event) {}
            public function forgetPushed() {}
        };

        return new class($test, $noOpDispatcher) {
            public function __construct(
                private object $test,
                private \Illuminate\Contracts\Events\Dispatcher $dispatcher,
            ) {}

            // event() MUST return PendingBroadcast — broadcast() has that strict return type.
            public function event(mixed $event): \Illuminate\Broadcasting\PendingBroadcast
            {
                $this->test->capturedEvent = $event;
                return new \Illuminate\Broadcasting\PendingBroadcast($this->dispatcher, $event);
            }

            // Stub methods required by the BroadcastFactory contract
            public function connection(?string $name = null): static { return $this; }
            public function socket(mixed $request = null): mixed { return null; }
            public function auth(mixed $request): mixed { return null; }
            public function validAuthenticationResponse(mixed $request, mixed $result): mixed { return null; }
        };
    });
}

beforeEach(function () {
    $this->capturedEvent = null;
    bindRecordingBroadcaster($this);
});

test('Swal::broadcast() dispatches SweetAlert2BroadcastEvent on a public channel', function () {
    Swal::broadcast('my-channel', ['title' => 'Hello!']);

    expect($this->capturedEvent)->toBeInstanceOf(SweetAlert2BroadcastEvent::class);
    expect($this->capturedEvent->broadcastOn())->toBeInstanceOf(Channel::class);
    expect($this->capturedEvent->broadcastWith())->toBe(['title' => 'Hello!']);
});

test('Swal::broadcastSuccess() dispatches with success icon', function () {
    Swal::broadcastSuccess('my-channel', ['title' => 'Done!']);

    expect($this->capturedEvent)->toBeInstanceOf(SweetAlert2BroadcastEvent::class);
    expect($this->capturedEvent->broadcastWith())->toBe(['title' => 'Done!', 'icon' => 'success']);
});

test('Swal::broadcastError() dispatches with error icon', function () {
    Swal::broadcastError('my-channel', ['title' => 'Oops!']);

    expect($this->capturedEvent->broadcastWith())->toMatchArray(['icon' => 'error']);
});

test('Swal::broadcastWarning() dispatches with warning icon', function () {
    Swal::broadcastWarning('my-channel', ['title' => 'Watch out!']);

    expect($this->capturedEvent->broadcastWith())->toMatchArray(['icon' => 'warning']);
});

test('Swal::broadcastInfo() dispatches with info icon', function () {
    Swal::broadcastInfo('my-channel', ['title' => 'FYI!']);

    expect($this->capturedEvent->broadcastWith())->toMatchArray(['icon' => 'info']);
});

test('Swal::broadcastQuestion() dispatches with question icon', function () {
    Swal::broadcastQuestion('my-channel', ['title' => 'Are you sure?']);

    expect($this->capturedEvent->broadcastWith())->toMatchArray(['icon' => 'question']);
});

test('Swal::broadcastToast() dispatches with toast flag', function () {
    Swal::broadcastToast('my-channel', ['title' => 'Toast!']);

    expect($this->capturedEvent->broadcastWith())->toMatchArray(['toast' => true]);
});

test('Swal::broadcastToastSuccess() dispatches with toast and success icon', function () {
    Swal::broadcastToastSuccess('my-channel', ['title' => 'Saved!']);

    expect($this->capturedEvent->broadcastWith())->toMatchArray(['toast' => true, 'icon' => 'success']);
});

test('Swal::broadcastPrivate() dispatches SweetAlert2BroadcastEvent on a PrivateChannel', function () {
    Swal::broadcastPrivate('user.42', ['title' => 'Hello!']);

    expect($this->capturedEvent)->toBeInstanceOf(SweetAlert2BroadcastEvent::class);
    expect($this->capturedEvent->broadcastOn())->toBeInstanceOf(PrivateChannel::class);
    expect($this->capturedEvent->broadcastWith())->toBe(['title' => 'Hello!']);
});

test('Swal::broadcastPrivateSuccess() dispatches on a PrivateChannel with success icon', function () {
    Swal::broadcastPrivateSuccess('user.42', ['title' => 'Done!']);

    expect($this->capturedEvent->broadcastOn())->toBeInstanceOf(PrivateChannel::class);
    expect($this->capturedEvent->broadcastWith())->toMatchArray(['icon' => 'success']);
});

test('Swal::broadcastPrivateToastSuccess() dispatches on a PrivateChannel with toast and success icon', function () {
    Swal::broadcastPrivateToastSuccess('user.42', ['title' => 'Saved!']);

    expect($this->capturedEvent->broadcastOn())->toBeInstanceOf(PrivateChannel::class);
    expect($this->capturedEvent->broadcastWith())->toMatchArray(['toast' => true, 'icon' => 'success']);
});
