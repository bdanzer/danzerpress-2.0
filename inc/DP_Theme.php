<?php
namespace Danzerpress;

use Danzerpress\Twig\TwigLoading;
use Danzerpress\Rest\RestApi;
use Danzerpress\Ajax\Ajax;
use Danzerpress\autoinstaller\RegisterPlugins;

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

        add_action( 'admin_init', [$this, 'jp_sync_acf_fields'] );

        if (class_exists('Timber')) {
            new TwigLoading;
        }
        
        new RegisterPlugins;
        new RestApi;
        new Ajax;
    }

    /**
     * Function that will update ACF fields via JSON file update
     */
    public function jp_sync_acf_fields() {

        // vars
        $groups = acf_get_field_groups();
        $sync 	= array();

        // bail early if no field groups
        if( empty( $groups ) )
            return;

        // find JSON field groups which have not yet been imported
        foreach( $groups as $group ) {
            
            // vars
            $local 		= acf_maybe_get( $group, 'local', false );
            $modified 	= acf_maybe_get( $group, 'modified', 0 );
            $private 	= acf_maybe_get( $group, 'private', false );
            
            // ignore DB / PHP / private field groups
            if( $local !== 'json' || $private ) {
                
                // do nothing
                
            } elseif( ! $group[ 'ID' ] ) {
                
                $sync[ $group[ 'key' ] ] = $group;
                
            } elseif( $modified && $modified > get_post_modified_time( 'U', true, $group[ 'ID' ], true ) ) {
                
                $sync[ $group[ 'key' ] ]  = $group;
            }
        }

        // bail if no sync needed
        if( !empty( $sync ) ) {
            add_action( 'admin_notices', function() {
                echo '<div class="error"><p>ACF needs to be synced: <a href="' . esc_url( admin_url( 'edit.php?post_type=acf-field-group' ) ) . '">Sync Here</a></p></div>';
            });
        }
    }
}