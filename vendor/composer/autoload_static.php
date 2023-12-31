<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8f336c09abfe0d7ad6f73d54a1c96ed7
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Habib\\Button_Shortcode_Creator\\App\\' => 35,
            'Habib\\Button_Shortcode_Creator\\' => 31,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Habib\\Button_Shortcode_Creator\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Habib\\Button_Shortcode_Creator\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8f336c09abfe0d7ad6f73d54a1c96ed7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8f336c09abfe0d7ad6f73d54a1c96ed7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8f336c09abfe0d7ad6f73d54a1c96ed7::$classMap;

        }, null, ClassLoader::class);
    }
}
