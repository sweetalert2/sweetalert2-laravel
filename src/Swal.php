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
 * @package SweetAlert2\Laravel
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
        'loaderHtml',
    ];
    /**
     * Displays a SweetAlert2 popup.
     *
     * Example usage:
     * <code>
     *     Swal::fire(['title' => 'Hello World!', 'icon' => 'success']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function fire(array $options = []): void
    {
        session()->put(self::SESSION_KEY, $options);
    }

    /**
     * Displays a SweetAlert2 popup with a success icon.
     *
     * Example usage:
     * <code>
     *     Swal::success(['title' => 'Hello World!']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
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
     * @param array $options Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
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
     * @param array $options Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
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
     * @param array $options Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
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
     * @param array $options Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
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
     * @param array $options Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
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
     * @param array $options Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
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
     * @param array $options Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
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
     * @param array $options Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
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
     * @param array $options Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
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
     * @param array $options Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public static function toastQuestion(array $options = []): void
    {
        self::fire([...$options, 'toast' => true, 'icon' => 'question']);
    }

    /**
     * Separates callback options from regular options.
     * Callbacks will be stored with a special marker to be rendered as JavaScript functions.
     *
     * @param array $options The full options array
     * @return array Array with 'options' (regular JSON-serializable options) and 'callbacks' (JavaScript callback strings)
     */
    public static function separateCallbacks(array $options): array
    {
        $callbacks = [];
        $regularOptions = [];

        foreach ($options as $key => $value) {
            if (in_array($key, self::CALLBACK_OPTIONS) && is_string($value)) {
                $callbacks[$key] = $value;
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
     * @param array $data The session data containing options
     * @return string JavaScript code to call Swal.fire()
     */
    public static function renderFireCall(array $data): string
    {
        $separated = self::separateCallbacks($data);
        $options = $separated['options'];
        $callbacks = $separated['callbacks'];

        if (empty($callbacks)) {
            // No callbacks, just render as JSON
            return 'Swal.fire(' . json_encode($options, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . ')';
        }

        // Build JavaScript object with callbacks
        $parts = [];
        
        // Add regular options
        foreach ($options as $key => $value) {
            $parts[] = json_encode($key) . ': ' . json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        // Add callbacks as raw JavaScript
        foreach ($callbacks as $key => $callback) {
            $parts[] = json_encode($key) . ': ' . $callback;
        }

        return 'Swal.fire({' . implode(', ', $parts) . '})';
    }
}