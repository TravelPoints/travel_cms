<?php

function _preload($preload, string $pattern = "/\.php$/", array $ignore = [])
{
    if (is_array($preload)) {
        foreach ($preload as $path) {
            _preload($path, $pattern, $ignore);
        }
    } else if (is_string($preload)) {
        $path = $preload;
        if (!in_array($path, $ignore)) {
            if (is_dir($path)) {
                if ($dh = opendir($path)) {
                    while (($file = readdir($dh)) !== false) {
                        if ($file !== "." && $file !== "..") {
                            _preload($path . "/" . $file, $pattern, $ignore);
                        }
                    }
                    closedir($dh);
                }
            } else if (is_file($path) && preg_match($pattern, $path) && !opcache_compile_file($path)) {
                trigger_error('Preloading Failed', E_USER_ERROR);
            }
        }
    }
}

set_include_path(get_include_path() . PATH_SEPARATOR .
    realpath('/Users/arthur/www/turgid_cms/vendor/laravel'));
_preload(['/Users/arthur/www/turgid_cms/vendor/laravel']);
