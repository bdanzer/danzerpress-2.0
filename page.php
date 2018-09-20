<?php
use Danzerpress\Contexts\Danzerpress;
use Danzerpress\AcfContextHelper;

$context = Danzerpress::get_context();
$context['posts'] = Timber::get_posts();

Timber::render('templates/page.twig', $context, Danzerpress::get_ttl());