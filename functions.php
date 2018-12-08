<?php

/**
 * Check if Timber is activated
 */
if ( ! class_exists( 'Timber' ) ) {
    add_action( 'admin_notices', function() {
    echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
  });
  return;
}

if (!class_exists('Danzerpress\\DP')) {
    add_action( 'admin_notices', function() {
    echo '<div class="error"><p>Danzerpress theme depends on Danzerpress plugin to work, please <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '"> activate</a></p></div>';
  });

  if (!is_admin()) {
    wp_die('DanzerPress Plugin is required for theme to work, please <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '"> activate</a>');
  }

  return;
}

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

//Vender autload
$autoload_path = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $autoload_path ) ) {
    require_once( $autoload_path );
}

function dpDie($value) {
  if (is_array($value)) {
    var_dump($value);
  } else {
    var_dump($value);
  }
  die;
}

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/bdanzer/danzerpress-2.0/',
	__FILE__,
	'danzerpress'
);
//Optional: If you're using a private repository, specify the access token like this:
//$myUpdateChecker->setAuthentication('your-token-here');

//Optional: Set the branch that contains the stable release.
//$myUpdateChecker->setBranch('master');

$myUpdateChecker->getVcsApi()->enableReleaseAssets();

new Danzerpress\DP_Theme;

function is_section() {
  $sections = 'Danzerpress\\Sections';
  if (class_exists($sections)) {
    return $sections::is_section();
  } 

  return false;
}