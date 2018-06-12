<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/timber.php', 			// Twig magic
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


if( function_exists('acf_add_options_page') ) { 
  acf_add_options_page(array(
    'page_title'  => 'Theme General Settings',
    'menu_title'  => 'DanzerPress Settings',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
  
  acf_add_options_sub_page(array(
    'page_title'  => 'Theme Header Settings',
    'menu_title'  => 'Header',
    'parent_slug' => 'theme-general-settings',
  ));
  
  acf_add_options_sub_page(array(
    'page_title'  => 'Theme Footer Settings',
    'menu_title'  => 'Footer',
    'parent_slug' => 'theme-general-settings',
  ));
}

/**
 * Enqueue scripts and styles.
 */
function danzerpress_scripts() {

  // Animate.css
  wp_enqueue_style('animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css');

  // Font Awesome
  wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/3be2183bb5.js', array(), null, true );
    
  // Google Fonts
  wp_enqueue_style( 'google fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i|Raleway:400,500,700,800|Roboto', false);

  // Google Fonts
  //wp_enqueue_script( 'wow', get_template_directory() . '/dist/scripts/wow.js', array(), null, true);

}
add_action( 'wp_enqueue_scripts', 'danzerpress_scripts' );