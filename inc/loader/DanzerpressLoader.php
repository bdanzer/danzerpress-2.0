<?php
namespace Danzerpress\loader;

Class DanzerpressLoader {
    public static function compile($file, $context, $ttl = null) 
    {
        if (class_exists('Timber')) {
            return \Timber::compile($file, $context, $ttl);
        }
    }

    public static function render($file, $context, $ttl = null) 
    {
        if (class_exists('Timber')) {
            \Timber::render($file, $context, $ttl);
        }
    }
}