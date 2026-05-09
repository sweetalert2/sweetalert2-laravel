<?php declare(strict_types=1);

namespace SweetAlert2\Laravel\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use SweetAlert2\Laravel\Swal;

/**
 * Laravel SweetAlert2 Broadcasting Event {@see https://github.com/sweetalert2/sweetalert2-laravel}
 *
 * Dispatched via {@see Swal::broadcast()} or {@see Swal::broadcastPrivate()} to send real-time
 * SweetAlert2 popups to the browser over Laravel's broadcasting system (Reverb, Pusher, Ably, etc.)
 * without a page reload.
 *
 * Include `@include('sweetalert2::broadcast', ['channel' => 'my-channel'])` in your layout to
 * receive these events using Laravel Echo.
 *
 * @see https://sweetalert2.github.io
 */
class SweetAlert2BroadcastEvent implements ShouldBroadcastNow
{
    /**
     * @param  string  $channel  The broadcasting channel name.
     * @param  array  $options  SweetAlert2 options to display in the popup.
     * @param  bool  $private  Whether to broadcast on a private channel.
     */
    public function __construct(
        private string $channel,
        public array $options,
        private bool $private = false,
    ) {}

    /**
     * Returns the channel(s) this event should broadcast on.
     */
    public function broadcastOn(): Channel|PrivateChannel
    {
        return $this->private
            ? new PrivateChannel($this->channel)
            : new Channel($this->channel);
    }

    /**
     * The event name used by Laravel Echo on the frontend.
     * A leading dot in the Echo listener (`.sweetalert2-message`) means the exact name is used.
     */
    public function broadcastAs(): string
    {
        return Swal::SESSION_KEY;
    }

    /**
     * The data sent with the broadcast.
     */
    public function broadcastWith(): array
    {
        return $this->options;
    }
}
