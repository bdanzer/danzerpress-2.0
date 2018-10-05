<?php
namespace Danzerpress\Images;

use Timber\Image as TimberImage;

class Image extends TimberImage {
    protected $classes;

    public function __construct($image, $classes = null) 
    {
        parent::__construct($image);
        $this->classes = $classes;
    }

    public function build_image() 
    {
        $image = [
            'src' => $this->src(),
            'alt' => $this->alt(),
            'class' => $this->classes
        ];

        $int = random_int(10, 99);
        $image_src = ($image['src']) ? $image['src'] : 'https://picsum.photos/1920/10' . $int . '/?random';
        $image_alt = ($image['alt']) ? $image['alt'] : 'Image';
        $image_class = ($image['class']) ? $image['class'] : '';

        $class = 'class="' . $image_class . '" ';
        $src = 'src="' . $image_src . '"';
        $alt = 'alt="' . $image_alt . '"';

        $html = '<img ' . $class . $alt . ' ' . $src . '/>';

        return $html;
    }
}