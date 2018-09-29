<?php
namespace Danzerpress\Contexts;

use Timber\Post as TimberPost;

class DanzerpressPostContext extends TimberPost {
    public function __construct($pid = null) 
    {   
        parent::__construct($pid);
    }

    public function get_header_thumbnail()
    {
        if (get_post_thumbnail_id($this->id)) {
            return get_post_thumbnail_id($this->id);
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

    public function hide_nav() 
    {
        $header = get_field('hide_nav');
        return $header;
    }

    public function get_header_title() 
    {
        if (is_home()) {
            return 'News';
        } else {
            return 'ello';
        }
    }
}