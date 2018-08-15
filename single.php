<?php
use Danzerpress\Contexts\Danzerpress;
use Danzerpress\Contexts\DanzerpressPostContext;

$context = Danzerpress::get_context();
$context['post'] = Timber::get_post(get_the_ID(), new DanzerpressPostContext());
$context['sidebar_primary'] = Timber::get_widgets('sidebar-primary');

Timber::render('templates/single.twig', $context, Danzerpress::get_ttl());