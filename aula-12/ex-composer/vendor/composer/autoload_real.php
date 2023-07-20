<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit1c95e869f80e1db8cc3a2337f4a0e098
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit1c95e869f80e1db8cc3a2337f4a0e098', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit1c95e869f80e1db8cc3a2337f4a0e098', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit1c95e869f80e1db8cc3a2337f4a0e098::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
