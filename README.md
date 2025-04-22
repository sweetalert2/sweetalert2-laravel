## Installation

1. Install the sweetalert2 npm and composer packages

```sh
npm install sweetalert2
composer require sweetalert2/laravel
```

2. Add global `window.Swal` to your global JS (usually it's `resources/js/app.js` file):

```js
import Swal from 'sweetalert2'

window.Swal = Swal
```

3. Include the SweetAlert2 template in your layout file (usually `resources/views/layouts/app.blade.php`):

```blade
@include('sweetalert2::index')
```

## Usage

```php
use SweetAlert2\Laravel\Swal;

Swal::fire([
    'title' => 'Laravel + SweetAlert2 = <3',
    'text' => 'This is a simple alert using SweetAlert2',
    'icon' => 'success',
    'confirmButtonText' => 'Cool'
]);
```

The full list of options can be found in the [SweetAlert2 documentation](https://sweetalert2.github.io/#configuration).

![SweetAlert2 Laravel](sweetalert2-laravel.png)

## FAQ

### 1. What's the difference with [realrashid/sweet-alert](https://github.com/realrashid/sweet-alert) package?

The `realrashid/sweet-alert` package is too opinionated and too complex: facade, midddleware, adding vendor files to apps, whatnot 🤯. And all that with 0 tests.

This package is simple, straightforward, and unopinionated. It's API is aimed to be as close as possible to the original [sweetalert2](https://sweetalert2.github.io/#configuration).

It simply provides a way to use SweetAlert2 in your Laravel application without touching JS or CSS files.

### 2. How it works?

Simple and straightforward:

- The `Swal::fire()` method will pass the options to the [flashed session](https://laravel.com/docs/12.x/session#flash-data).
- The blade partial template will check if there are any flashed session data and will render the SweetAlert2.

### 3. Any limitations?

SweetAlert2 is a JavaScript package and some of its options are JS callbacks. It's not possible to use them in the `Swal::fire()` method.
If you need to use JS callbacks, you have to go to JS and use the SweetAlert2 API directly.

### 4. Can I use SweetAlert2 without this package?

Yes, you can use SweetAlert2 without this package. Just `npm install sweetalert2` and use the SweetAlert2 API directly in your JS files.
