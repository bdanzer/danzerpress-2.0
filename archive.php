<?php
use Danzerpress\contexts\Danzerpress;

$context = Danzerpress::get_context();
$context['posts'] = Timber::get_posts();

Timber::render('index.twig', $context, Danzerpress::get_ttl());