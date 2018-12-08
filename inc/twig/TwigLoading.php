<?php
namespace Danzerpress\Twig;

use Timber;
use Danzerpress\DP;

Class TwigLoading {
    protected $plugin_url;

    public function __construct() 
    {
        if (class_exists(DP::class)) {
            $this->plugin_url = DP::get_dir() . '/resources/templates';
        } 

        add_action('init', function() {
            $this->timber_dir();
            $this->timber_locations();
        });
    }
  
    public function timber_dir() 
    {
        Timber::$dirname = 'resources';
    }
  
    public function timber_locations() 
    {
        $locations = [
            get_stylesheet_directory().'/resources/templates',
            get_template_directory().'/resources/templates',
            $this->plugin_url
        ];

        Timber::$locations = apply_filters('dp_timber_locations', $locations);
    }
}