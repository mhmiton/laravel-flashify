# Laravel Flashify

Showing multiple flash messages for the laravel or laravel-livewire.

<p align="center">
    <img src="https://dev.mhmiton.com/laravel-flashify/public/laravel-flashify.gif" alt="laravel-flashify" width="100%" height="auto" />
</p>

### Supported Plugins

- [Sweetalert2](https://sweetalert2.github.io)
- [iziToast](https://izitoast.marcelodolza.com)

### Installation

Install through composer:

```
composer require mhmiton/laravel-flashify
```

Publish the package's configuration file:

```
php artisan vendor:publish --tag=flashify-config
```

Publish the package's views:

```
php artisan vendor:publish --tag=flashify-views
```

### Scripts

Include the package scripts in your layout file.

```html
@flashifyScripts

or

@include('flashify::components.scripts')

or

// Laravel 7 or greater
<x-flashify::scripts />
```

**Note:** You can modify these scripts by publishing the views file.

### Usage

Layout example - if [Inject Plugins](#inject-plugins) is enabled:

```html
<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Flashify</title>
    </head>

    <body>

        <x-flashify::scripts />
    </body>
</html>
```

Layout example - if [Inject Plugins](#inject-plugins) is disabled:

```html
<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Flashify</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css" />
    </head>

    <body>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

        <x-flashify::scripts />
    </body>
</html>
```

### Flash Message

```php
flashify('Created', 'Data has been created successfully.');
```

```php
flashify('Created', 'Data has been created successfully.', 'success', []);
```

or

```php
flashify()
    ->plugin('swal')
    ->title('Created')
    ->text('Data has been created successfully.')
    ->type('success')
    ->fire();
```

or

```php
flashify([
    'plugin' => 'izi-toast',
    'title' => 'Updated',
    'text' => 'Data has been updated successfully.',
    'type' => 'success',
]);
```

### Flash Message With Response

```php
redirect()
    ->route('name')
    ->flashify('Created', 'Data has been created successfully.');
```

### Flash Message With Livewire

```php
flashify()
    ->plugin('swal')
    ->title('Created')
    ->text('Data has been created successfully.')
    ->type('success')
    ->livewire($this)
    ->fire();
```
or

```php
flashify([
    'plugin' => 'izi-toast',
    'title' => 'Updated',
    'text' => 'Data has been updated successfully.',
    'type' => 'success',
    'livewire' => $this,
]);
```

### Presets

Define preset messages in the config file "presets" key.

```php
'presets' => [
    'created' => [
        'plugin'  => 'swal',
        'title'   => 'Created',
        'text'    => 'Data has been created successfully.',
        'type'    => 'success',
        'options' => [],
    ],
],
```

Show preset messages:

```php
flashify('created');
```

```php
flashify()->fire('created');
```

```php
flashify([
    'preset' => 'created',
]);
```

```php
redirect()
    ->route('name')
    ->flashify('created');
```

```php
flashify()->livewire($this)->fire('created');
```

```php
flashify([
    'preset' => 'created',
    'livewire' => $this,
]);
```

### Flash Message With JavaScript

```js
LaravelFlashify.fire({
    title: 'Created',
    text: 'Data has been created successfully.',
    type: 'success',
    options: {},
});
```

### Config

The config file is located at `config/flashify.php` after publishing the config file.

#### Plugin

```php
/*
|--------------------------------------------------------------------------
| Plugin Configurations
|--------------------------------------------------------------------------
|
| Sweetalert2 plugin is used by default.
|
| Supported Plugin: 'swal', 'izi-toast'
|
*/

'plugin' => 'swal',
```

#### Inject Plugins

```php
/*
|--------------------------------------------------------------------------
| Auto-inject Plugin Assets
|--------------------------------------------------------------------------
|
| This configuration option controls whether or not to auto-inject plugin assets.
|
| By default, auto-inject is enabled.
|
| When auto-inject is enabled, the package will automatically inject the necessary
| JavaScript and CSS for plugins.
|
*/

'inject_plugins' => true,
```

#### Trans

```php
/*
|--------------------------------------------------------------------------
| Auto Translation For The Title and Text
|--------------------------------------------------------------------------
|
| Auto Translation is enabled by default.
|
| If the trans value is true, it will be use laravel lang helper __()
| for the title and text.
|
*/

'trans' => true,
```

#### Presets

```php
/*
|--------------------------------------------------------------------------
| Preset Messages
|--------------------------------------------------------------------------
|
| Define preset messages that will be reused.
|   ---> plugin => 'plugin'
|   ---> title => 'Message Title'
|   ---> text => 'Message Text'
|   ---> type => 'success|info|warning|error' (as per plugin)
|   ---> options => {Plugin Options}
|
*/

'presets' => [
    'created' => [
        'plugin'  => 'swal',
        'title'   => 'Created',
        'text'    => 'Data has been created successfully.',
        'type'    => 'success',
        'options' => [],
    ],

    .....
]
```

### License

Copyright (c) 2022 Mehediul Hassan Miton <mhmiton.dev@gmail.com>

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
