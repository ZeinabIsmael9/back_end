<?php
namespace Illuminates;

use Illuminates\Sessions\Session;

class FrameworkSetting
{
    /**
     * Set Time Zone on mvc
     * @return void
     */
    public static function setTimeZone()
    {
        date_default_timezone_set(config('app.timezone'));
    }
    /**
     * Get current Time Zone on mvc
     * @return string
     */
    public static function getTimeZone()
    {
        return date_default_timezone_get();
    }

    /**
     * Get current locale language
     * @return string
     */
    public static function getlocale()
    {
        return Session::get('locale')?Session::get('locale'):config('app.locale');
    }

    /**
     * change current locale language
     * @param string $locale
     * 
     * @return string
     */
    public static function setlocale(string $locale): string
    {
        Session::make('locale', $locale);
        return Session::get('locale');
    }
}