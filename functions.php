<?php

if (!did_action('dp_plugin_init')) {
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
 * Allows wordpress theme updates via github
 */
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/bdanzer/danzerpress-2.0/',
	__FILE__,
	'danzerpress'
);

$myUpdateChecker->setAuthentication('9fbf7903495b966d0b5616ed2a6fa4563823c099');
$myUpdateChecker->setBranch((function_exists('get_field') && get_field('dp_env', 'options')) ? get_field('dp_env', 'options') : 'master');
$myUpdateChecker->getVcsApi()->enableReleaseAssets();

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
$sage_includes = [ 			// Twig magic
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

new Danzerpress\DP_Theme;