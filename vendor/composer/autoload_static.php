<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitee1dfe7bc5c3d2e183cf3ce9f79edd4b
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Danzerpress\\Twig\\' => 17,
            'Danzerpress\\Rest\\' => 17,
            'Danzerpress\\Images\\' => 19,
            'Danzerpress\\Controllers\\' => 24,
            'Danzerpress\\Contexts\\' => 21,
            'Danzerpress\\Chunks\\' => 19,
            'Danzerpress\\Ajax\\' => 17,
            'Danzerpress\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Danzerpress\\Twig\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc/twig',
        ),
        'Danzerpress\\Rest\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc/rest',
        ),
        'Danzerpress\\Images\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc/images',
        ),
        'Danzerpress\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc/controllers',
        ),
        'Danzerpress\\Contexts\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc/contexts',
        ),
        'Danzerpress\\Chunks\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc/chunks',
        ),
        'Danzerpress\\Ajax\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc/ajax',
        ),
        'Danzerpress\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitee1dfe7bc5c3d2e183cf3ce9f79edd4b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitee1dfe7bc5c3d2e183cf3ce9f79edd4b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
