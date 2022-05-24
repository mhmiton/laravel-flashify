<?php

namespace Mhmiton\LaravelFlashify;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class LaravelFlashifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/flashify.php', 'flashify');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'flashify');

        $this->registerPublishables();

        $this->registerMacros();

        $this->registerBladeDirectives();
    }

    protected function registerPublishables()
    {
        if (! $this->app->runningInConsole()) return;

        $this->publishes([
            __DIR__ . '/../config/flashify.php' => base_path('config/flashify.php'),
        ], 'flashify-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/flashify'),
        ], 'flashify-views');
    }

    protected function registerMacros()
    {
        Response::macro('flashify', function () {
            call_user_func_array('flashify', func_get_args());

            return $this;
        });

        RedirectResponse::macro('flashify', function () {
            call_user_func_array('flashify', func_get_args());

            return $this;
        });

        if (class_exists(\Livewire\Redirector::class)) {
            \Livewire\Redirector::macro('flashify', function () {
                call_user_func_array('flashify', func_get_args());

                return $this;
            });
        }
    }

    protected function registerBladeDirectives()
    {
        Blade::directive('flashifyScripts', function () {
            return "{!! flashifyScripts() !!}";
        });
    }
}
