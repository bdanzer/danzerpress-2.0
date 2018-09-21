<?php
namespace Danzerpress\Image;

class Image {
    public function __construct($image) 
    {
        $this->build_image($image);
    }

    public function build_image($image) 
    {
        $image = [
            'src' => wp_get_attachment_url($image),
            'alt' => get_post_meta($image, '_wp_attachment_image_alt', true)
        ];

        $image_src = ($image['src']) ? $image['src'] : 'https://picsum.photos/1920/1080';
        $image_alt = $image['alt'];

        $src = "src='$image_src'";
        $alt = "alt='$image_alt'";

        $html = '<img ' . $alt . ' ' . $src . '/>';

        return $html;
    }
}