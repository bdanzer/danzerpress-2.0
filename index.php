<?php
use Danzerpress\Contexts\Danzerpress;
use Danzerpress\loader\DanzerpressLoader;

$context = Danzerpress::get_context();
$context['posts'] = Timber::get_posts();
$context['sidebar_primary'] = Timber::get_widgets('sidebar-primary');

DanzerpressLoader::render('index.twig', $context, Danzerpress::get_ttl());