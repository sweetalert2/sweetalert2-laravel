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
