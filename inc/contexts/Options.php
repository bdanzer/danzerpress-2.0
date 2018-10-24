<?php
namespace Danzerpress\Contexts;

class Options {
    public function __construct() 
    {
        
    }

    public function get_theme_color() 
    {
        $color = get_field('theme_color', 'options');
        
        if (!empty($color)) {
            return $color;
        }
        return false;
    }

    public function get_menu_background() 
    {
        return get_field('menu_background', 'options');
    }

    public function get_menu_color() 
    {
        return get_field('menu_color', 'options');
    }

    public function get_dark_logo() 
    {
        return get_field('non_transparent_logo', 'options');
    }

    public function get_button_animation() 
    {
        return get_field('button_animation', 'options');
    }

    public function get_section_padding() 
    {
        return get_field('section_padding', 'options');
    }

    public function get_title_section_padding() 
    {
        return get_field('title_section_padding', 'options');
    }

    public function get_trans_nav() 
    {
        if (is_front_page()) {
            return false;
        }
        return get_field('navigation_style', 'options');
    }

    public function get_light_logo() 
    {
        return get_field('transparent_logo', 'options');
    }

    public function hide_nav() 
    {
        $header = get_field('hide_nav');
        return $header;
    }

    public function hide_header() 
    {
        $header = get_field('title_screen_header');
        
        if (is_front_page()) {
            $header = true;
        }
        
        return $header;
    }
}