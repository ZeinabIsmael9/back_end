<?php

namespace Illuminates\Locales;

use Illuminates\FrameworkSetting;

class Lang
{
    /**
     * @param string $key
     * @param string $locale
     * 
     * @return string|null
     */
    private static function loadJsonTranslation(string $key, string $locale, array|null $attributes = []): string|null
    {
        // print_r($attributes);
        $path = base_path('app/lang/' . $locale . '.json');
        if (file_exists($path)) {
            $json = file_get_contents($path);
            $lang = json_decode($json, true);
        }
            return isset($lang[$key]) ? self::attribute($lang[$key], $attributes) : null;
    }

    /**
     * @param array $key
     * @param string $locale
     * 
     * @return string|null
     */
    private static function loadPhpTranslation(array $key, string $locale, array|null $attributes = []): string|null
    {
        // print_r($attributes);
        $path = base_path('app/lang/' . $locale . '/' . $key[0] . '.php');
        if (file_exists($path)) {
            $lang = include $path;
        }
            return isset($key[1]) ? self::attribute($lang[$key[1]], $attributes) : null;
        }
        
    

    /**
     * @param array $key
     * @param string $locale
     * 
     * @return string|null
     */
    private static function loadTranslation(array $key, string $locale, array|null $attributes = []): string|null
    {
        return isset($key[1])
            ? self::loadPhpTranslation($key, $locale, $attributes) // هنا!
            : self::loadJsonTranslation($key[0], $locale, $attributes); // وهنا!
    }


    /**
     * @param string $trans
     * 
     * @return array
     */
    public static function path(string $trans, array|null $attributes = []): array
    {
        //  print_r($attributes);

        $key = explode('.', $trans);
        $locale = (string) FrameworkSetting::getlocale();
        $translation = self::loadTranslation($key, $locale, $attributes);

        if (!$translation) {
            $fallback_locale = (string) config('app.fallback_locale');
            $translation = self::loadTranslation($key, $fallback_locale, $attributes);
            $locale = $fallback_locale;
        }

        return [
            'has_trans' => isset($translation),
            'trans' => is_string($translation) ? $translation : $trans,
        ];
    }


    /**
     * @param string $trans
     * 
     * @return bool
     */
    public static function has(string $trans): bool
    {
        return static::path($trans)['has_trans'];
    }

    /**
     * @param string $trans
     * 
     * @return string
     */
    public static function get(string $trans, array $attributes = []): string
    {
        // print_r($attributes);
        return static::path($trans, $attributes)['trans'];
    }

    /**
     * @param string $lang
     * @param array $attributes=[]
     * 
     * @return string
     */
    /**
     * @param string $lang
     * @param array $attributes=[]
     * 
     * @return string
     */
    protected static function attribute(string $lang, array $attributes = []): string
    {
        $new_value = $lang;
        foreach ($attributes as $key => $value) {
            $new_value = str_replace(':' . $key, $value, $new_value);
        }
        return $new_value;
    }
}
