<?php
use Danzerpress\Contexts\Danzerpress;

$context = Danzerpress::get_context();
$context['posts'] = Timber::get_posts();

Timber::render('templates/index.twig', $context, Danzerpress::get_ttl());