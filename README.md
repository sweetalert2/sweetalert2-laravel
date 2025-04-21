## Installation

```sh
# 1. Install the sweetalert2 npm package
npm install sweetalert2

# 2. Install the sweetalert2 Laravel composer package
composer require sweetalert2/laravel

# 3. Publish the assets
php artisan vendor:publish --provider="SweetAlert2\Laravel\ServiceProvider" --force
```

## Usage

Include the SweetAlert2 template in your layout file (usually `resources/views/layouts/app.blade.php`):

```html
@include('vendor.sweetalert2')
```

And the last step is to tell Laravel to show the actual alert:

```php
return view('welcome')->withSwal([
    'title' => 'Welcome to Laravel',
    'text' => 'This is a simple alert using SweetAlert2',
    'icon' => 'success',
    'confirmButtonText' => 'Cool'
]);
```

![SweetAlert2 Laravel](sweetalert2-laravel.png)
