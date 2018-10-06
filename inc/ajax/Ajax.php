<?php
namespace Danzerpress\Ajax;

Class Ajax {
    public function __construct() 
    {
        add_action('wp_ajax_createHTML', [$this, 'infinite_scroll']);
        add_action('wp_ajax_nopriv_createHTML', [$this, 'infinite_scroll']);
    }

    public function infinite_scroll() {
        $data = $_POST['data'];
        
        $posts = Timber::get_posts([
            'posts_per_page' => $data['per_page'],
            'paged' => $data['page'],
            'post_type' => 'post'
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
            $html .= Timber::compile('content.twig', $context);
        }

        wp_send_json_success($html);        
        die();
    }
}