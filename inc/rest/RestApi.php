<?php
namespace Danzerpress\Rest;

use Timber;
use Danzerpress\Images\Image;

class RestApi {
    public function __construct() 
    {
        add_action('rest_api_init', [$this, 'rest_api_init']);
    }

    public function rest_api_init() {
        register_rest_field('post', 'thumbnail', 
            [
                'get_callback' => [$this, 'thumbnail'], 
                'update_callback' => null, 
                'schema' => null
            ]
        ); 
        register_rest_field('post', 'post_excerpt', 
            [
                'get_callback' => [$this, 'excerpt'], 
                'update_callback' => null, 
                'schema' => null
            ]
        ); 
    }

    public function thumbnail($object, $field_name, $request){
        $image_id = get_post_thumbnail_id($object['id']);
        $image = new Image($image_id);
        return $image->build_image(); 
    }

    public function excerpt($object, $field_name, $request){
        $content = get_the_content($object['id']);
        return wp_trim_words($content, 20, '');
    }
}


