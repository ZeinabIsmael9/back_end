<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitce5a02c072e481abf961c6e1ad140220
{
    public static $files = array (
        'fa834c7dc44636c79c6243499ba823c6' => __DIR__ . '/..' . '/zeinabismael/elfarmework/helpers/elframework_helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Illuminates\\' => 12,
        ),
        'E' => 
        array (
            'Elfarmework\\' => 12,
        ),
        'C' => 
        array (
            'Contracts\\' => 10,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Illuminates\\' => 
        array (
            0 => __DIR__ . '/..' . '/zeinabismael/elfarmework/illuminates',
        ),
        'Elfarmework\\' => 
        array (
            0 => __DIR__ . '/..' . '/zeinabismael/elfarmework/framework',
        ),
        'Contracts\\' => 
        array (
            0 => __DIR__ . '/..' . '/zeinabismael/elfarmework/Contracts',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitce5a02c072e481abf961c6e1ad140220::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitce5a02c072e481abf961c6e1ad140220::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitce5a02c072e481abf961c6e1ad140220::$classMap;

        }, null, ClassLoader::class);
    }
}
