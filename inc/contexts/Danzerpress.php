<?php

namespace Danzerpress\Contexts;

use Timber;
use Danzerpress\Chunks\Chunks;

class Danzerpress {
    public static $context;

    public static function get_context() 
    {
        if (!isset(self::$context)) {
            self::$context = [];
            self::$context['menu'] = new Timber\Menu;
            self::$context['body_class'] = self::get_body_class();
            self::$context['site'] = new DanzerpressSite();
            self::$context['chunks'] = new Chunks();
            self::$context['options'] = new Options();
        }
        return self::$context;
    }

    public static function get_ttl() 
    {
        $cache = (get_field('cache', 'option')) ? 900 : false;
        return $cache;
    }

    public static function get_body_class() 
    {
        $classes = [
            'dp-no-js', 
            'drawer', 
            'drawer--top',
            'drawer--navbarTopGutter'
        ];

        if (self::$context['options']->hide_header && false == self::$contenxt['options']->hide_nav) {
            $classes[] = 'hide-header';
            $classes[] = 'danzerpress-non-trans';
        } else {
            $classes[] = 'danzerpress-trans';
        }

        $body_class = get_body_class();
        $body_class = array_merge($body_class, apply_filters('dp_body_class', $classes));
        $body_class = implode(' ', $body_class);

        return $body_class;
    }
}