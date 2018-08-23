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

    public function get_header_title() 
    {
        if (is_home()) {
            return 'News';
        } else {
            return get_the_title();
        }
    }

    public function get_theme_color() 
    {
        $color = get_field('theme_color', 'options');
        
        if (!empty($color)) {
            return $color;
        }
        return false;
    }

    public function get_header_thumbnail()
    {
        if (get_the_post_thumbnail_url()) {
            return get_the_post_thumbnail_url();
        }
    }

    public function display_sidebar() 
    {
        $sidebar_option = get_field('sidebar');
        return $sidebar_option;
    }

    public function hide_header() 
    {
        $header = get_field('title_screen_header');
        
        if (is_front_page()) {
            $header = false;
        }
        
        return $header;
    }
}