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
}