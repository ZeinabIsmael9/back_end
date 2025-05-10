<?php

namespace Illuminates\Locales;

use Illuminates\FrameworkSetting;

class Lang
{
    public static function path(string $trans): array
    {
        $key = explode('.', $trans);
        $locale = self::locle();

        $lang = [];
        $has_trans = false;

        if (isset($key[1])) {
            $path = base_path('app/lang/' . $locale . '/' . $key[0] . '.php');
            if (file_exists($path)) {
                $lang = include $path;
                $has_trans = isset($lang[$key[1]]);
                $trans = $has_trans ? $lang[$key[1]] : $trans;
                if(!$has_trans){
                    $path = base_path('app/lang/' . config('app.fallback_locale') . '/' . $key[0] . '.php');
                        $lang = include $path;
                        $has_trans = isset($lang[$key[1]]);
                        $trans = $has_trans ? $lang[$key[1]] : $trans;
                }
            }
        } elseif (isset($key[0])) {
            $path = base_path('app/lang/' . $locale . '.json');
            if (file_exists($path)) {
                if(!$has_trans){
                    $json = file_get_contents($path);
                    $lang = json_decode($json, true);
                    $has_trans = isset($lang[$key[0]]);
                    $trans = $has_trans ? $lang[$key[0]] : $trans;
                }
            }
        }
        // var_dump($lang[$key[0]] ?? null, $has_trans);
        return [
            'has_trans' => $has_trans,
            'trans' => $trans,
            'lang' => $lang
        ];
    }

    public static function has(string $trans): bool
    {
        return static::path($trans)['has_trans'];
    }

    public static function get(string $trans): string
    {
        return static::path($trans)['trans'];
    }
    public static function locle(): string
    {
        return FrameworkSetting::getlocale();
    }
}
