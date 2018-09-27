<?php
namespace Danzerpress\Images;

use Timber\Image as TimberImage;

class Image extends TimberImage {
    public function __construct($image) 
    {
        parent::__construct($image);
    }

    public function build_image() 
    {
        $image = [
            'src' => $this->src(),
            'alt' => $this->alt()
        ];

        $image_src = ($image['src']) ? $image['src'] : 'https://picsum.photos/1920/1080';
        $image_alt = ($image['alt']) ? $image['alt'] : 'Image';

        $src = "src='$image_src'";
        $alt = "alt='$image_alt'";

        $html = '<img ' . $alt . ' ' . $src . '/>';

        return $html;
    }
}