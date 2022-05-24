<?php

namespace Mhmiton\LaravelFlashify;

class Flashify
{
    public $sessionKey;

    public $plugin;

    public $title = '';

    public $text = '';

    public $type = 'success';

    public $options = [];

    public $preset = [];

    public $livewire = null;

    public function __construct()
    {
        $this->plugin = config('flashify.plugin', 'swal');

        $this->sessionKey = config('flashify.key', 'flashifies');
    }

    public function plugin($plugin)
    {
        $this->plugin = $plugin;

        return $this;
    }

    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    public function text($text)
    {
        $this->text = $text;

        return $this;
    }

    public function type($type)
    {
        $this->type = $type;

        return $this;
    }

    public function options($options = [])
    {
        $this->plugin = $options['plugin'] ?? $this->plugin;

        $this->options = \Arr::except($options, ['plugin']);

        return $this;
    }

    public function preset($preset)
    {
        $this->preset = config("flashify.presets.{$preset}", $this->preset);

        return $this;
    }

    public function livewire($livewire)
    {
        $this->livewire = $livewire;

        return $this;
    }

    public function all()
    {
        return session($this->sessionKey, []);
    }

    public function get()
    {
        return collect($this->all());
    }

    public function clear()
    {
        return session()->forget($this->sessionKey);
    }

    public function fireFromArray($data = [])
    {
        foreach ($data as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $this->fire();
    }

    public function fire($title = null, $text = null, $type = 'success', $options = [])
    {
        if (func_num_args()) {
            return $this->title($title)->text($text)->type($type)->options($options)->fire();
        }

        if ($this->livewire && request()->hasHeader('X-Livewire')) {
            return $this->livewire->dispatchBrowserEvent('flashify', $this->make());
        }

        session()->push($this->sessionKey, $this->make());

        return $this;
    }

    public function config()
    {
        $config = config('flashify');

        if (! is_array($config['preset'] ?? null)) {
            return $config;
        }

        $preset = collect($config['preset'])->map(function ($item) {
            $item['title'] = $this->transable($item['title']);
            $item['text'] = $this->transable($item['text']);

            return $item;
        })->all();

        $config['preset'] = $preset;

        return $config;
    }

    protected function transable($string)
    {
        return config('flashify.trans', true) ? __($string) : $string;
    }

    protected function make()
    {
        $this->preset($this->title);

        return (object) [
            'plugin' => $this->preset['plugin'] ?? $this->plugin,
            'title' => $this->transable($this->preset['title'] ?? $this->title),
            'text' => $this->transable($this->preset['text'] ?? $this->text),
            'type' => $this->preset['type'] ?? $this->type,
            'options' => $this->preset['options'] ?? $this->options,
        ];
    }
}
