<?php declare(strict_types=1);

namespace SweetAlert2\Laravel\Traits;

use SweetAlert2\Laravel\Swal;

/**
 * Laravel & Livewire SweetAlert2 Integration {@see https://github.com/sweetalert2/sweetalert2-laravel}
 *
 * This trait should be used in a Livewire context to dispatch SweetAlert2 events within the component lifecycle.
 *
 * Non Livewire contexts should use the regular Laravel integration {@see Swal}. If this trait is used outside a
 * Livewire context it will flash the SweetAlert2 event to the session like normal.
 *
 * Example usage:
 * <code>
 *     $this->swalFire(['title' => 'Hello World!', 'icon' => 'success']);
 * </code>
 *
 * @package SweetAlert2\Laravel
 * @see https://sweetalert2.github.io
 */
trait WithSweetAlert
{
    /**
     * Displays a SweetAlert2 popup.
     *
     * Example usage:
     * <code>
     *     $this->swalFire(['title' => 'Hello World!', 'icon' => 'success']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public function swalFire(array $options = []): void
    {
        if (method_exists($this, 'dispatch')) {
            $this->dispatch('sweetalert2', ...$options);
        } else {
            session()->flash('sweetalert2', $options);
        }
    }

    /**
     * Displays a SweetAlert2 popup with a success icon.
     *
     * Example usage:
     *  <code>
     *      $this->swalSuccess(['title' => 'Hello World!']);
     *  </code>
     *
     * @param array $options Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public function swalSuccess(array $options = []): void
    {
        $this->swalFire([...$options, 'icon' => 'success']);
    }

    /**
     * Displays a SweetAlert2 popup with an error icon.
     *
     * Example usage:
     * <code>
     *     $this->swalError(['title' => 'Hello World!']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public function swalError(array $options = []): void
    {
        $this->swalFire([...$options, 'icon' => 'error']);
    }

    /**
     * Displays a SweetAlert2 popup with a warning icon.
     *
     * Example usage:
     * <code>
     *     $this->swalWarning(['title' => 'Hello World!']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public function swalWarning(array $options = []): void
    {
        $this->swalFire([...$options, 'icon' => 'warning']);
    }

    /**
     * Displays a SweetAlert2 popup with an info icon.
     *
     * Example usage:
     * <code>
     *     $this->swalInfo(['title' => 'Hello World!']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public function swalInfo(array $options = []): void
    {
        $this->swalFire([...$options, 'icon' => 'info']);
    }

    /**
     * Displays a SweetAlert2 popup with a question icon.
     *
     * Example usage:
     * <code>
     *     $this->swalQuestion(['title' => 'Hello World!']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the popup {@see https://sweetalert2.github.io/#configuration}.
     */
    public function swalQuestion(array $options = []): void
    {
        $this->swalFire([...$options, 'icon' => 'question']);
    }

    /* Toast Functions */

    /**
     * Displays a SweetAlert2 toast.
     *
     * Example usage:
     * <code>
     *     $this->swalToast(['title' => 'Hello World!', 'icon' => 'success']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public function swalToast(array $options = []): void
    {
        $this->swalFire([...$options, 'toast' => true]);
    }

    /**
     * Displays a SweetAlert2 toast with a success icon.
     *
     * Example usage:
     * <code>
     *     $this->swalToastSuccess(['title' => 'Hello World!']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public function swalToastSuccess(array $options = []): void
    {
        $this->swalFire([...$options, 'toast' => true, 'icon' => 'success']);
    }

    /**
     * Displays a SweetAlert2 toast with an error icon.
     *
     * Example usage:
     * <code>
     *     $this->swalToastError(['title' => 'Hello World!']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public function swalToastError(array $options = []): void
    {
        $this->swalFire([...$options, 'toast' => true, 'icon' => 'error']);
    }

    /**
     * Displays a SweetAlert2 toast with a warning icon.
     *
     * Example usage:
     * <code>
     *     $this->swalToastWarning(['title' => 'Hello World!']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public function swalToastWarning(array $options = []): void
    {
        $this->swalFire([...$options, 'toast' => true, 'icon' => 'warning']);
    }

    /**
     * Displays a SweetAlert2 toast with an info icon.
     *
     * Example usage:
     * <code>
     *     $this->swalToastInfo(['title' => 'Hello World!']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public function swalToastInfo(array $options = []): void
    {
        $this->swalFire([...$options, 'toast' => true, 'icon' => 'info']);
    }

    /**
     * Displays a SweetAlert2 toast with a question icon.
     *
     * Example usage:
     * <code>
     *     $this->swalToastQuestion(['title' => 'Hello World!']);
     * </code>
     *
     * @param array $options Optional configuration parameters to customize the toast {@see https://sweetalert2.github.io/#configuration}.
     */
    public function swalToastQuestion(array $options = []): void
    {
        $this->swalFire([...$options, 'toast' => true, 'icon' => 'question']);
    }
}