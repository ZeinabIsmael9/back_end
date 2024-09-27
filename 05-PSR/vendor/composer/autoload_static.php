<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5556a2c8308fcbdd4a47659cfb2de652
{
    public static $files = array (
        '3781243791c7836e22c75726e38320cb' => __DIR__ . '/../..' . '/app/helper.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mypackage\\Oop\\' => 14,
            'My\\Project\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mypackage\\Oop\\' => 
        array (
            0 => __DIR__ . '/..' . '/mypackage/oop/src',
        ),
        'My\\Project\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\Models\\User' => __DIR__ . '/../..' . '/app/Models/User.php',
        'App\\Views\\Views' => __DIR__ . '/../..' . '/app/Views/View.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5556a2c8308fcbdd4a47659cfb2de652::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5556a2c8308fcbdd4a47659cfb2de652::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5556a2c8308fcbdd4a47659cfb2de652::$classMap;

        }, null, ClassLoader::class);
    }
}