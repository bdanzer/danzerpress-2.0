<?php
use Danzerpress\Contexts\Danzerpress;

$context = Danzerpress::get_context();
$context['posts'] = Timber::get_posts();
$context['sidebar_primary'] = Timber::get_widgets('sidebar-primary');

Timber::render('index.twig', $context, Danzerpress::get_ttl());