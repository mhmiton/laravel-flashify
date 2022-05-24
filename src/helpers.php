<?php

if (! function_exists('flashify')) {
    function flashify($title = null, $text = null, $type = 'success', $options = [])
    {
        $flashify = new Mhmiton\LaravelFlashify\Flashify();

        if (func_num_args()) {
            if (is_array($title)) {
                return $flashify->fireFromArray($title);
            }

            return $flashify->fire($title, $text, $type, $options);
        }

        return $flashify;
    }
}

if (! function_exists('flashifyScripts')) {
    function flashifyScripts()
    {
        return view('flashify::components.scripts')->render();
    }
}
