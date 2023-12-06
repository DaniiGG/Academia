<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit512d663eb44937374da1a7d33f6845f3
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Utils\\' => 6,
        ),
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'L' => 
        array (
            'Lib\\' => 4,
        ),
        'D' => 
        array (
            'Danie\\Academia\\' => 15,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Utils\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Utils',
        ),
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Models',
        ),
        'Lib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Lib',
        ),
        'Danie\\Academia\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Controllers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit512d663eb44937374da1a7d33f6845f3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit512d663eb44937374da1a7d33f6845f3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit512d663eb44937374da1a7d33f6845f3::$classMap;

        }, null, ClassLoader::class);
    }
}