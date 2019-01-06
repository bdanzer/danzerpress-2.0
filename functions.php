<?php

if (!class_exists('Danzerpress\\DP')) {
    if (!is_admin() && !is_wplogin()) {
        wp_die('DanzerPress Plugin is required for theme to work, please <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '"> activate</a>');
    }
}

if (!class_exists('Timber')) {
    if (!is_admin() && !is_wplogin()) {
        wp_die('Timber is required for theme to work, please <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '"> activate</a>');
    }
}

if (!function_exists('get_field')) {
    if (!is_admin() && !is_wplogin()) {
        wp_die('Advanced Custom Fields Pro is required for theme to work, please <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '"> activate</a>');
    }
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
  'lib/customizer.php', // Theme customizer
  'lib/plugin_activation.php'
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

function is_wplogin(){
    $ABSPATH_MY = str_replace(array('\\','/'), DIRECTORY_SEPARATOR, ABSPATH);
    return ((in_array($ABSPATH_MY.'wp-login.php', get_included_files()) || in_array($ABSPATH_MY.'wp-register.php', get_included_files()) ) || (isset($_GLOBALS['pagenow']) && $GLOBALS['pagenow'] === 'wp-login.php') || $_SERVER['PHP_SELF']== '/wp-login.php');
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