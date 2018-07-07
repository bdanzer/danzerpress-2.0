<?php

namespace Danzerpress\Contexts;

use Timber;
use Danzerpress\Contexts\DanzerpressSite;

class Danzerpress {
    public static $context;

    public function __construct() 
    {

    }

    public static function get_context() 
    {
        if (!isset(self::$context)) {
            self::$context = [];
            self::$context['menu'] = new Timber\Menu;
            self::$context['body_class'] = implode(' ', get_body_class());
            self::$context['site'] = new DanzerpressSite();
        }
        return self::$context;
    }

    public static function get_ttl() 
    {
        $cache = (get_field('cache', 'option')) ? 900 : null;
        return $cache;
    }
}