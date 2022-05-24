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

```

@flashifyScripts

or

@include('flashify::components.scripts')

or

// Laravel 7 or greater

<x-flashify::scripts />
```

**Note:** You can modify these scripts by publishing the views file.

### Usage

Layout example:

```
<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Flashify</title>
    </head>

    <body>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

        <x-flashify::scripts />
    </body>
</html>
```

### Flash Message

```
flashify('Created', 'Data has been created successfully.');
```

```
flashify('Created', 'Data has been created successfully.', 'success', []);
```

```
flashify()
    ->plugin('swal')
    ->title('Created')
    ->text('Data has been created successfully.')
    ->type('success')
    ->fire();
```

```
flashify([
    'plugin' => 'izi-toast',
    'title' => 'Updated',
    'text' => 'Data has been updated successfully.',
    'type' => 'success',
]);
```

### Flash Message With Response

```
redirect()
    ->route('name')
    ->flashify('Created', 'Data has been created successfully.');
```

### Flash Message With Livewire

```
flashify()
    ->plugin('swal')
    ->title('Created')
    ->text('Data has been created successfully.')
    ->type('success')
    ->livewire($this)
    ->fire();
```

```
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

```
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

```
flashify('created');
```

```
flashify()->fire('created');
```

```
flashify([
    'preset' => 'created',
]);
```

```
redirect()
    ->route('name')
    ->flashify('created');
```

```
flashify()->livewire($this)->fire('created');
```

```
flashify([
    'preset' => 'created',
    'livewire' => $this,
]);
```

### Flash Message With JavaScript

```
LaravelFlashify.fire({
    title: 'Created',
    text: 'Data has been created successfully.',
    type: 'success',
    options: {},
});
```

### Config

The config file is located at `config/flashify.php` after publishing the config file.

**Plugin**

```
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

**Trans**

```
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

**Presets**

```
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
