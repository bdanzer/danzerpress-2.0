<?php
namespace Danzerpress\Chunks;

class Chunks {
    public function __construct() {}

    public function __call($name, $arguments) 
    {
        $namespaces = ['Danzerpress\\', 'Danzerpress\\Chunks\\'];
        $namespaces = apply_filters('danzerpress_chunk_namespaces', $namespaces);
        
        foreach ($namespaces as $namespace) {
            $class = $namespace . $name;

            if (class_exists($class)) {
                $class::chunk($arguments);
            }
        }
    }
}