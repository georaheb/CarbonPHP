<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf7bcaf88814232fa6202e75e65efaeed
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'C' => 
        array (
            'CarbonPHP\\Interfaces\\' => 21,
            'CarbonPHP\\Helpers\\' => 18,
            'CarbonPHP\\Error\\' => 16,
            'CarbonPHP\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'CarbonPHP\\Interfaces\\' => 
        array (
            0 => __DIR__ . '/../..' . '/interfaces',
        ),
        'CarbonPHP\\Helpers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/helpers',
        ),
        'CarbonPHP\\Error\\' => 
        array (
            0 => __DIR__ . '/../..' . '/error',
        ),
        'CarbonPHP\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Mustache' => 
            array (
                0 => __DIR__ . '/..' . '/mustache/mustache/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf7bcaf88814232fa6202e75e65efaeed::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf7bcaf88814232fa6202e75e65efaeed::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitf7bcaf88814232fa6202e75e65efaeed::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
