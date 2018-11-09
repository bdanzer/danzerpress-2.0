<?php
namespace Danzerpress\Images;

use Timber\Image as TimberImage;

class Image extends TimberImage {
    protected $classes;
    protected $attr;
    protected $cache_id = false;

    public function __construct($image, $classes = null, $attr = null) 
    {
        $validate_int = filter_var('2', FILTER_VALIDATE_INT);
        $image_id = ($validate_int) ? $image : null;

        parent::__construct($image_id);
        
        if ($image) {
            $this->cache_id = $image;
        }
        
        if ($attr) {
            $this->attr = $attr;
        }

        $this->classes = $classes;
    }

    public function build_image() 
    {
        //$html = get_transient($this->cache_id . '_dp_image');
        // if ($html && $this->cache_id) {
        //     return $html;
        // }
        
        $image = [
            'src' => $this->src(),
            'alt' => $this->alt(),
            'attr' => $this->attr,
            'class' => $this->classes
        ];

        $int = random_int(10, 99);
        $image_src = ($image['src']) ? $image['src'] : 'https://picsum.photos/1920/10' . $int . '/?random';
        $image_alt = ($image['alt']) ? $image['alt'] : 'Image';
        $image_class = ($image['class']) ? $image['class'] : '';

        $class = 'class="' . $image_class . '" ';
        $src = 'src="' . $image_src . '"';
        $alt = 'alt="' . $image_alt . '" ';
        $attr = $image['attr'];

        $html = '<img ' . $class . $alt . $attr . ' ' . $src . '/>';

        if (strrpos($html, '#src#')) {
            $html = str_replace('#src#', $image_src, $html);
        }
        //set_transient($this->cache_id . '_dp_image', $html, 999);

        return $html;
    }
}