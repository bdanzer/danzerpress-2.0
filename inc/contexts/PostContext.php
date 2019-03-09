<?php
namespace Danzerpress\contexts;

use Timber\Post as TimberPost;

class PostContext extends TimberPost {
    public $options; 

    public function __construct($pid = null) 
    {   
        parent::__construct($pid);
    }

    public function get_header_thumbnail()
    {   
        if ($thumbnail_id = get_field('title_area_image', 'options')) {
            return $thumbnail_id;
        }

        if ($thumbnail_id = get_post_thumbnail_id($this->id)) {
            return $thumbnail_id;
        }
    }

    public function display_sidebar() 
    {
        $sidebar_option = get_field('sidebar');
        return $sidebar_option;
    }
}