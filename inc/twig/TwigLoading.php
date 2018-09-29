<?php
namespace Danzerpress\Twig;

use Timber;

Class TwigLoading {
    protected $plugin_url;

    public function __construct() 
    {
        if (true === IS_DEV) {
            $this->plugin_url = WP_PLUGIN_DIR . '/danzerpress-plugin/resources/templates';
        } else {
            $this->plugin_url = WP_PLUGIN_DIR . '/dp-plugin/resources/templates';
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
        Timber::$locations = [
            $this->plugin_url,
            get_template_directory().'/resources',
            get_stylesheet_directory().'/resources'
        ];
    }
}