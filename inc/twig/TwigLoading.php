<?php
namespace Danzerpress\Twig;

Class TwigLoading {

    public function __construct() 
    {
        add_action('init', function() {
            $this->timber_dir();
            $this->timber_locations();
        });
    }
  
    public function timber_dir() 
    {
        \Timber::$dirname = 'resources';
    }
  
    public function timber_locations() 
    {
        if (true === IS_DEV) {
            $plugin_url = plugins_url() . '/danzerpress-plugin/';
        } else {
            $plugin_url = plugins_url() . '/dp-plugin/';
        }

        \Timber::$locations = [
            $this->plugin_url . '/resources', 
            $this->plugin_url . '/resources/templates',
            get_stylesheet_directory().'/resources',
            get_template_directory().'/resources'
        ];
    }
}