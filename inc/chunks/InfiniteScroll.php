<?php
namespace Danzerpress\Chunks;

use Timber;

class InfiniteScroll {
    public static function chunk($context) 
    {
        Timber::render('parts/infinite_scroll.twig', $context[0]);
    }
}