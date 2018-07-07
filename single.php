<?php
use Danzerpress\Contexts\Danzerpress;

$context = Danzerpress::get_context();
$context['post'] = Timber::get_post(get_the_ID());

Timber::render('templates/single.twig', $context, Danzerpress::get_ttl());