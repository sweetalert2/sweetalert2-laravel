<?php declare(strict_types=1);

namespace SweetAlert2\Laravel;

/**
 * Laravel SweetAlert2 Integration {@see https://github.com/sweetalert2/sweetalert2-laravel}
 *
 * Livewire components can use the trait {@see WithSweetAlert} to dispatch SweetAlert2 events within the component lifecycle.
 *
 * Example usage:
 * <code>
 *     Swal::fire(['title' => 'Hello World!', 'icon' => 'success']);
 * </code>
 *
 * @see https://sweetalert2.github.io
 */
class Swal
{
    public const SESSION_KEY = 'sweetalert2-message';

    /**
     * List of SweetAlert2 options that accept callback functions.
     * These will be rendered as JavaScript functions instead of JSON strings.
     *
     * @var array
     */
    public const CALLBACK_OPTIONS = [
        'didOpen',
        'didClose',
        'didDestroy',
        'willOpen',
        'willClose',
        'didRender',
        'preDeny',
        'preConfirm',
        'inputValidator',
        'inputOptions',
    ];

    private const JSON_FLAGS = JSON_HEX_TAG | JSON_INVALID_UTF8_SUBSTITUTE | JSON_THROW_ON_ERROR;

    /**
     * Displays a SweetAlert2 popup.
     *
     * Example usage:
     * <code>
     *     Swal::fire(['title' => 'Hello World!', 'icon' => 'success']);
     * </code>
     *
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function fire(array $options = []): void
    {
        session()->flash(self::SESSION_KEY, $options);
    }

    /**
     * Displays a SweetAlert2 popup with a success icon.
     *
     * Example usage:
     * <code>
     *     Swal::success(['title' => 'Hello World!']);
     * </code>
     *
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function success(array $options = []): void
    {
        self::fire([...$options, 'icon' => 'success']);
    }

    /**
     * Displays a SweetAlert2 popup with an error icon.
     *
     * Example usage:
     * <code>
     *     Swal::error(['title' => 'Hello World!']);
     * </code>
     *
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function error(array $options = []): void
    {
        self::fire([...$options, 'icon' => 'error']);
    }

    /**
     * Displays a SweetAlert2 popup with a warning icon.
     *
     * Example usage:
     * <code>
     *     Swal::warning(['title' => 'Hello World!']);
     * </code>
     *
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function warning(array $options = []): void
    {
        self::fire([...$options, 'icon' => 'warning']);
    }

    /**
     * Displays a SweetAlert2 popup with an info icon.
     *
     * Example usage:
     * <code>
     *     Swal::info(['title' => 'Hello World!']);
     * </code>
     *
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function info(array $options = []): void
    {
        self::fire([...$options, 'icon' => 'info']);
    }

    /**
     * Displays a SweetAlert2 popup with a question icon.
     *
     * Example usage:
     * <code>
     *     Swal::question(['title' => 'Hello World!']);
     * </code>
     *
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function question(array $options = []): void
    {
        self::fire([...$options, 'icon' => 'question']);
    }

    /* Toast Functions */

    /**
     * Displays a SweetAlert2 toast.
     *
     * Example usage:
     * <code>
     *     Swal::toast(['title' => 'Hello World!', 'icon' => 'success']);
     * </code>
     *
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function toast(array $options = []): void
    {
        self::fire([...$options, 'toast' => true]);
    }

    /**
     * Displays a SweetAlert2 toast with a success icon.
     *
     * Example usage:
     * <code>
     *     Swal::toastSuccess(['title' => 'Hello World!']);
     * </code>
     *
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function toastSuccess(array $options = []): void
    {
        self::fire([...$options, 'toast' => true, 'icon' => 'success']);
    }

    /**
     * Displays a SweetAlert2 toast with an error icon.
     *
     * Example usage:
     * <code>
     *     Swal::toastError(['title' => 'Hello World!']);
     * </code>
     *
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function toastError(array $options = []): void
    {
        self::fire([...$options, 'toast' => true, 'icon' => 'error']);
    }

    /**
     * Displays a SweetAlert2 toast with a warning icon.
     *
     * Example usage:
     * <code>
     *     Swal::toastWarning(['title' => 'Hello World!']);
     * </code>
     *
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function toastWarning(array $options = []): void
    {
        self::fire([...$options, 'toast' => true, 'icon' => 'warning']);
    }

    /**
     * Displays a SweetAlert2 toast with an info icon.
     *
     * Example usage:
     * <code>
     *     Swal::toastInfo(['title' => 'Hello World!']);
     * </code>
     *
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function toastInfo(array $options = []): void
    {
        self::fire([...$options, 'toast' => true, 'icon' => 'info']);
    }

    /**
     * Displays a SweetAlert2 toast with a question icon.
     *
     * Example usage:
     * <code>
     *     Swal::toastQuestion(['title' => 'Hello World!']);
     * </code>
     *
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function toastQuestion(array $options = []): void
    {
        self::fire([...$options, 'toast' => true, 'icon' => 'question']);
    }

    /* Broadcasting Functions */

    /**
     * Broadcasts a SweetAlert2 popup to a public Laravel broadcasting channel in real time.
     *
     * Requires Laravel Echo to be configured on the frontend.
     * Include `@include('sweetalert2::broadcast', ['channel' => 'my-channel'])` in your layout.
     *
     * Example usage:
     * <code>
     *     Swal::broadcast('my-channel', ['title' => 'Done!', 'icon' => 'success']);
     * </code>
     *
     * @param  string  $channel  The public broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcast(string $channel, array $options = []): void
    {
        broadcast(new Events\SweetAlert2BroadcastEvent($channel, $options));
    }

    /**
     * Broadcasts a SweetAlert2 popup to a public broadcasting channel with a success icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastSuccess('my-channel', ['title' => 'Done!']);
     * </code>
     *
     * @param  string  $channel  The public broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastSuccess(string $channel, array $options = []): void
    {
        self::broadcast($channel, [...$options, 'icon' => 'success']);
    }

    /**
     * Broadcasts a SweetAlert2 popup to a public broadcasting channel with an error icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastError('my-channel', ['title' => 'Oops!']);
     * </code>
     *
     * @param  string  $channel  The public broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastError(string $channel, array $options = []): void
    {
        self::broadcast($channel, [...$options, 'icon' => 'error']);
    }

    /**
     * Broadcasts a SweetAlert2 popup to a public broadcasting channel with a warning icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastWarning('my-channel', ['title' => 'Watch out!']);
     * </code>
     *
     * @param  string  $channel  The public broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastWarning(string $channel, array $options = []): void
    {
        self::broadcast($channel, [...$options, 'icon' => 'warning']);
    }

    /**
     * Broadcasts a SweetAlert2 popup to a public broadcasting channel with an info icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastInfo('my-channel', ['title' => 'FYI!']);
     * </code>
     *
     * @param  string  $channel  The public broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastInfo(string $channel, array $options = []): void
    {
        self::broadcast($channel, [...$options, 'icon' => 'info']);
    }

    /**
     * Broadcasts a SweetAlert2 popup to a public broadcasting channel with a question icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastQuestion('my-channel', ['title' => 'Are you sure?']);
     * </code>
     *
     * @param  string  $channel  The public broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastQuestion(string $channel, array $options = []): void
    {
        self::broadcast($channel, [...$options, 'icon' => 'question']);
    }

    /**
     * Broadcasts a SweetAlert2 toast to a public broadcasting channel.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastToast('my-channel', ['title' => 'Hello!', 'icon' => 'success']);
     * </code>
     *
     * @param  string  $channel  The public broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastToast(string $channel, array $options = []): void
    {
        self::broadcast($channel, [...$options, 'toast' => true]);
    }

    /**
     * Broadcasts a SweetAlert2 toast to a public broadcasting channel with a success icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastToastSuccess('my-channel', ['title' => 'Saved!']);
     * </code>
     *
     * @param  string  $channel  The public broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastToastSuccess(string $channel, array $options = []): void
    {
        self::broadcast($channel, [...$options, 'toast' => true, 'icon' => 'success']);
    }

    /**
     * Broadcasts a SweetAlert2 toast to a public broadcasting channel with an error icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastToastError('my-channel', ['title' => 'Failed!']);
     * </code>
     *
     * @param  string  $channel  The public broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastToastError(string $channel, array $options = []): void
    {
        self::broadcast($channel, [...$options, 'toast' => true, 'icon' => 'error']);
    }

    /**
     * Broadcasts a SweetAlert2 toast to a public broadcasting channel with a warning icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastToastWarning('my-channel', ['title' => 'Warning!']);
     * </code>
     *
     * @param  string  $channel  The public broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastToastWarning(string $channel, array $options = []): void
    {
        self::broadcast($channel, [...$options, 'toast' => true, 'icon' => 'warning']);
    }

    /**
     * Broadcasts a SweetAlert2 toast to a public broadcasting channel with an info icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastToastInfo('my-channel', ['title' => 'Info!']);
     * </code>
     *
     * @param  string  $channel  The public broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastToastInfo(string $channel, array $options = []): void
    {
        self::broadcast($channel, [...$options, 'toast' => true, 'icon' => 'info']);
    }

    /**
     * Broadcasts a SweetAlert2 toast to a public broadcasting channel with a question icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastToastQuestion('my-channel', ['title' => 'Question?']);
     * </code>
     *
     * @param  string  $channel  The public broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastToastQuestion(string $channel, array $options = []): void
    {
        self::broadcast($channel, [...$options, 'toast' => true, 'icon' => 'question']);
    }

    /* Private Broadcasting Functions */

    /**
     * Broadcasts a SweetAlert2 popup to a private Laravel broadcasting channel in real time.
     *
     * Requires Laravel Echo to be configured on the frontend.
     * Include `@include('sweetalert2::broadcast', ['channel' => 'user.1', 'private' => true])` in your layout.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastPrivate('user.' . $user->id, ['title' => 'Done!', 'icon' => 'success']);
     * </code>
     *
     * @param  string  $channel  The private broadcasting channel name (without the `private-` prefix).
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastPrivate(string $channel, array $options = []): void
    {
        broadcast(new Events\SweetAlert2BroadcastEvent($channel, $options, private: true));
    }

    /**
     * Broadcasts a SweetAlert2 popup to a private broadcasting channel with a success icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastPrivateSuccess('user.' . $user->id, ['title' => 'Done!']);
     * </code>
     *
     * @param  string  $channel  The private broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastPrivateSuccess(string $channel, array $options = []): void
    {
        self::broadcastPrivate($channel, [...$options, 'icon' => 'success']);
    }

    /**
     * Broadcasts a SweetAlert2 popup to a private broadcasting channel with an error icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastPrivateError('user.' . $user->id, ['title' => 'Oops!']);
     * </code>
     *
     * @param  string  $channel  The private broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastPrivateError(string $channel, array $options = []): void
    {
        self::broadcastPrivate($channel, [...$options, 'icon' => 'error']);
    }

    /**
     * Broadcasts a SweetAlert2 popup to a private broadcasting channel with a warning icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastPrivateWarning('user.' . $user->id, ['title' => 'Watch out!']);
     * </code>
     *
     * @param  string  $channel  The private broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastPrivateWarning(string $channel, array $options = []): void
    {
        self::broadcastPrivate($channel, [...$options, 'icon' => 'warning']);
    }

    /**
     * Broadcasts a SweetAlert2 popup to a private broadcasting channel with an info icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastPrivateInfo('user.' . $user->id, ['title' => 'FYI!']);
     * </code>
     *
     * @param  string  $channel  The private broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastPrivateInfo(string $channel, array $options = []): void
    {
        self::broadcastPrivate($channel, [...$options, 'icon' => 'info']);
    }

    /**
     * Broadcasts a SweetAlert2 popup to a private broadcasting channel with a question icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastPrivateQuestion('user.' . $user->id, ['title' => 'Are you sure?']);
     * </code>
     *
     * @param  string  $channel  The private broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastPrivateQuestion(string $channel, array $options = []): void
    {
        self::broadcastPrivate($channel, [...$options, 'icon' => 'question']);
    }

    /**
     * Broadcasts a SweetAlert2 toast to a private broadcasting channel.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastPrivateToast('user.' . $user->id, ['title' => 'Hello!', 'icon' => 'success']);
     * </code>
     *
     * @param  string  $channel  The private broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastPrivateToast(string $channel, array $options = []): void
    {
        self::broadcastPrivate($channel, [...$options, 'toast' => true]);
    }

    /**
     * Broadcasts a SweetAlert2 toast to a private broadcasting channel with a success icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastPrivateToastSuccess('user.' . $user->id, ['title' => 'Saved!']);
     * </code>
     *
     * @param  string  $channel  The private broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastPrivateToastSuccess(string $channel, array $options = []): void
    {
        self::broadcastPrivate($channel, [...$options, 'toast' => true, 'icon' => 'success']);
    }

    /**
     * Broadcasts a SweetAlert2 toast to a private broadcasting channel with an error icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastPrivateToastError('user.' . $user->id, ['title' => 'Failed!']);
     * </code>
     *
     * @param  string  $channel  The private broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastPrivateToastError(string $channel, array $options = []): void
    {
        self::broadcastPrivate($channel, [...$options, 'toast' => true, 'icon' => 'error']);
    }

    /**
     * Broadcasts a SweetAlert2 toast to a private broadcasting channel with a warning icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastPrivateToastWarning('user.' . $user->id, ['title' => 'Warning!']);
     * </code>
     *
     * @param  string  $channel  The private broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastPrivateToastWarning(string $channel, array $options = []): void
    {
        self::broadcastPrivate($channel, [...$options, 'toast' => true, 'icon' => 'warning']);
    }

    /**
     * Broadcasts a SweetAlert2 toast to a private broadcasting channel with an info icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastPrivateToastInfo('user.' . $user->id, ['title' => 'Info!']);
     * </code>
     *
     * @param  string  $channel  The private broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastPrivateToastInfo(string $channel, array $options = []): void
    {
        self::broadcastPrivate($channel, [...$options, 'toast' => true, 'icon' => 'info']);
    }

    /**
     * Broadcasts a SweetAlert2 toast to a private broadcasting channel with a question icon.
     *
     * Example usage:
     * <code>
     *     Swal::broadcastPrivateToastQuestion('user.' . $user->id, ['title' => 'Question?']);
     * </code>
     *
     * @param  string  $channel  The private broadcasting channel name.
     * @param  array  $options  Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function broadcastPrivateToastQuestion(string $channel, array $options = []): void
    {
        self::broadcastPrivate($channel, [...$options, 'toast' => true, 'icon' => 'question']);
    }

    /**
     * Separates callback options from regular options.
     * Callbacks will be stored with a special marker to be rendered as JavaScript functions.
     *
     * @param  array  $options  The full options array
     * @return array Array with 'options' (regular JSON-serializable options) and 'callbacks' (JavaScript callback strings)
     */
    public static function separateCallbacks(array $options): array
    {
        $callbacks = [];
        $regularOptions = [];

        foreach ($options as $key => $value) {
            if (in_array($key, self::CALLBACK_OPTIONS) && is_string($value)) {
                if (self::isValidCallback($value)) {
                    $callbacks[$key] = $value;
                } else {
                    $regularOptions[$key] = $value;
                }
            } else {
                $regularOptions[$key] = $value;
            }
        }

        return [
            'options' => $regularOptions,
            'callbacks' => $callbacks,
        ];
    }

    /**
     * Renders the Swal.fire() JavaScript call with proper callback handling.
     *
     * Security: Callback strings are rendered as JavaScript and executed in the browser.
     * Only use callback strings from trusted sources (your backend code). Never pass
     * user input directly as callback strings to prevent XSS vulnerabilities.
     *
     * @param  array  $data  The session data containing options
     * @return string JavaScript code to call Swal.fire()
     */
    public static function renderFireCall(array $data): string
    {
        $separated = self::separateCallbacks($data);
        $options = $separated['options'];
        $callbacks = $separated['callbacks'];

        if (empty($callbacks)) {
            // No callbacks, just render as JSON
            return 'Swal.fire(' . self::jsonEncode($options) . ')';
        }

        // Build JavaScript object with callbacks
        $parts = [];

        // Add regular options
        foreach ($options as $key => $value) {
            $parts[] = self::jsonEncode($key) . ': ' . self::jsonEncode($value);
        }

        // Add callbacks as raw JavaScript (with sanitization to prevent XSS)
        foreach ($callbacks as $key => $callback) {
            $parts[] = json_encode($key, JSON_THROW_ON_ERROR) . ': ' . self::sanitizeCallback($callback);
        }

        return 'Swal.fire({' . implode(', ', $parts) . '})';
    }

    /**
     * Sanitizes a callback string to prevent XSS attacks.
     * Escapes closing script and style tags and other potentially dangerous patterns.
     *
     * @param  string  $callback  The callback string to sanitize
     * @return string The sanitized callback string
     */
    private static function sanitizeCallback(string $callback): string
    {
        // Escape closing script tags to prevent script injection (case-insensitive)
        // This matches any closing script tag regardless of attributes
        // Replace </ with <\/ to break the tag (JSON-safe escape)
        $callback = preg_replace('/<\/(script)/i', '<\\/$1', $callback);

        // Escape closing style tags (case-insensitive)
        $callback = preg_replace('/<\/(style)/i', '<\\/$1', $callback);

        return $callback;
    }

    /**
     * Validates that callback expressions are function-like JavaScript expressions.
     *
     * This avoids evaluating arbitrary JavaScript expressions such as `alert(1)`,
     * while still supporting common callback syntaxes used in SweetAlert2.
     */
    private static function isValidCallback(string $callback): bool
    {
        return preg_match(
            '/^\s*(?:async\s+)?function\b|^\s*(?:async\s*)?\([^)]*\)\s*=>|^\s*(?:async\s*)?[A-Za-z_$][A-Za-z0-9_$]*\s*=>/',
            $callback
        ) === 1;
    }

    private static function jsonEncode(mixed $value): string
    {
        return json_encode($value, self::JSON_FLAGS);
    }
}
