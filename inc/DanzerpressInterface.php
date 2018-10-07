<?php
namespace Danzerpress\Framework;

Class DanzerpressInterface {
    public function __construct() 
    {
        $plugin_url = plugins_url();
        define("DP_PLUGIN_URL", (true === IS_DEV) ? $plugin_url . '/danzerpress-plugin/' : $plugins_url . '/dp-plugin/');
        define("DP_CACHE_BUFFER", wp_get_theme()->parent()->get('Version'));
    }
}