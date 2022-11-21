<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9cac54c34905e2d5a70352725514f4c1
{
    public static $files = array (
        'ace6d88241f812b4accb2d847454aef6' => __DIR__ . '/..' . '/halaxa/json-machine/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'J' => 
        array (
            'JsonMachine\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'JsonMachine\\' => 
        array (
            0 => __DIR__ . '/..' . '/halaxa/json-machine/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9cac54c34905e2d5a70352725514f4c1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9cac54c34905e2d5a70352725514f4c1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
