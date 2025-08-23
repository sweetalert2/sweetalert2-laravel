<?php declare(strict_types=1);

namespace SweetAlert2\Laravel;

/**
 * Laravel SweetAlert2 Integration {@see https://github.com/sweetalert2/sweetalert2-laravel}
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
        session()->flash('sweetalert2', $options);
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
}