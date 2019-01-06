<?php
namespace Danzerpress;

use Danzerpress\Twig\TwigLoading;
use Danzerpress\Rest\RestApi;
use Danzerpress\Ajax\Ajax;
use Danzerpress\autoupdater\RegisterPlugins;

Class DP_Theme {
    public function __construct() 
    {
        if( function_exists('acf_add_options_page') ) { 
            acf_add_options_page(array(
                'page_title'  => 'Theme General Settings',
                'menu_title'  => 'DanzerPress Settings',
                'menu_slug'   => 'theme-general-settings',
                'capability'  => 'edit_posts',
                'redirect'    => false
            ));
            
            acf_add_options_sub_page(array(
                'page_title'  => 'Theme Header Settings',
                'menu_title'  => 'Header',
                'parent_slug' => 'theme-general-settings',
            ));
            
            acf_add_options_sub_page(array(
                'page_title'  => 'Theme Footer Settings',
                'menu_title'  => 'Footer',
                'parent_slug' => 'theme-general-settings',
            ));
        }

        if (class_exists('Timber')) {
            new TwigLoading;
        }
        
        new RegisterPlugins;
        new RestApi;
        new Ajax;
    }
}