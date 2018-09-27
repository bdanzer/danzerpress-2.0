<?php
namespace Danzerpress\Twig;

use Danzerpress\filters\MethodExtractor;
use Danzerpress\Images\Image;
use Timber;

class TwigFunctions extends MethodExtractor {
    public function __construct() 
    {
        parent::__construct();
        
    }

    public function __que_functions()
	{
		add_filter( 'timber/twig', function( \Twig_Environment $twig ) {
            foreach ($this->functions as $value) {
                $twig->addFunction( new Timber\Twig_Function( $value['name'], [$this, $value['name']] ));
            }
            return $twig;
        });
    }
    
    public function dpImage($image_id) {
        $image = new Image($image_id);
        return $image->build_image();
    }
}