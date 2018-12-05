<?php
namespace Danzerpress\Contexts;

use Timber\Site as TimberSite;

class DanzerpressSite extends TimberSite {
    public $body_class;
    
    public function __construct() 
    {
        parent::__construct();

        $this->body_class = get_body_class();
    }

    public function add_body_class($class) 
    {
        $this->body_class[] = $class;
    }

    public function implode_body() 
    {
        return implode(' ', $this->body_class);
    }

    public function get_header_title() 
    {
        if (is_home() && !is_front_page()) {
            return 'News';
        } elseif (is_front_page()) {
            return 'Front';
        } elseif (is_404()) {
            return '404';
        } elseif (is_search()) {
            return 'Search';
        } elseif (is_author()) {
            $author_id = get_query_var('author');
            $author_name = get_the_author_meta('user_nicename', $author_id);
            return ($author_name) ?: 'Author';
        } else {
            return get_the_title();
        }
    }

    public function header_hook() {

        $filter = apply_filters('danzerpress_menu_content', null);
        
        $html = '<li>';
        $html .= $filter;
        $html .= '</li>';

        $html = apply_filters('danzerpress_menu_html', $html);

        return $html;
    }
}