<?php
use Danzerpress\Controllers\Controller;

global $query_string;

wp_parse_str( $query_string, $search_query );
$context['posts'] = Timber::get_posts( $search_query );

$_search = new Controller('search.twig', $context);
$_search->render();