<?php
namespace Danzerpress\Ajax;

use Timber;

Class Ajax {
    public function __construct() 
    {
        add_action('wp_ajax_infinite_scroll', [$this, 'infinite_scroll']);
        add_action('wp_ajax_nopriv_infinite_scroll', [$this, 'infinite_scroll']);
        add_action('wp_enqueue_scripts', [$this, 'localize_scripts'], 101);
    }

    public function localize_scripts() 
    {
        wp_localize_script('sage/js', 'dp', array( 
            'home_url' => get_home_url()
        ));
    }

    /**
     * TODO: Add support for post types/archives
     */
    public function infinite_scroll() {
        $data = $_POST['data'];
        
        $posts = Timber::get_posts([
            'posts_per_page' => (isset($data['per_page'])) ? $data['per_page'] : 10,
            'paged' => $data['page'],
            'post_type' => 'post',
            'post_status' => 'publish'
        ]);

        if (empty($posts)) {
            wp_send_json_error(false);
        }

        $html = '';
        foreach ($posts as $post) {
            $context = [
                'post' => $post,
                'columns' => $data['columns']
            ];
            $html .= Timber::compile(apply_filters('ajax_template', [$data['template'], 'content.twig']), $context);
        }
        
        wp_send_json_success($html);        
        die();
    }
}