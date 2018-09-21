<?php

namespace Danzerpress\Image;

class Image {
    public function __construct($image) 
    {
        $this->build_image($image);
    }

    public function build_image($image) 
    {
        $src = 'src="' . $image['src'] . '"';
        $alt = 'alt="' . $image['alt'] . '"';

        $html = '<img' . $alt . $src;
        $html .= '/>';

        return $html;
    }
}