<?php

use App\Domains\Configuration\System\Models\SystemSetting;
use Illuminate\Support\Arr;

if (! function_exists('includeFilesInFolder')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeFilesInFolder($folder)
    {
        try {
            $rdi = new RecursiveDirectoryIterator($folder);
            $it = new RecursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (! function_exists('includeRouteFiles')) {

    /**
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        includeFilesInFolder($folder);
    }
}

if (! function_exists('getSysSetting')) {
    function getSysSetting($setting)
    {
        static $settings;

        if (is_null($settings)) {
//            $settings = Cache::remember('settings', 24*60, function() {
//                return Arr::pluck(SystemSetting::all()->toArray(), 'value', 'key');
//            });

            $settings = Arr::pluck(SystemSetting::all()->toArray(), 'value', 'key');
        }

        return (is_array($setting)) ? Arr::only($settings, $setting) : $settings[$setting];
    }
}

