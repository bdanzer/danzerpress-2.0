<?php
use Danzerpress\Contexts\Danzerpress;
use Danzerpress\Contexts\DanzerpressPostContext;

$context = Danzerpress::get_context();
$context['posts'] = Timber::get_posts();
$context['sidebar_primary'] = Timber::get_widgets('sidebar-primary');

Timber::render('templates/index.twig', $context, Danzerpress::get_ttl());