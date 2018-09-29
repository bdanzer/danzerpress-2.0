<?php

namespace Danzerpress\Contexts;

use Timber\Site as TimberSite;

class DanzerpressSite extends TimberSite {
    public $body_class;
    
    public function __construct() 
    {
        parent::__construct();

        $this->body_class = get_body_class();
    }

    public function add_body_class($class) 
    {
        $this->body_class[] = $class;
    }

    public function implode_body() 
    {
        return implode(' ', $this->body_class);
    }

    public function get_theme_color() 
    {
        $color = get_field('theme_color', 'options');
        
        if (!empty($color)) {
            return $color;
        }
        return false;
    }
}