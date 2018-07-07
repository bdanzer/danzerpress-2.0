<?php

namespace Danzerpress\Contexts;

use Timber;

class DanzerpressSite {
    public static $body_class;
    
    public function __construct() 
    {
        $body_class = get_body_class();
    }

    public function add_body_class($class) 
    {
        $this->$body_class[] = $class;
    }
}