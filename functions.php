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

//Vender autload
$autoload_path = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $autoload_path ) ) {
    require_once( $autoload_path );
}

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
 * Include aal if in admin
 */
if (is_admin()) {
  require_once get_template_directory() . '/inc/aal/aryo-activity-log.php';
  AAL_Main::instance();

  if (get_current_user_id() <= 2) {
    require_once get_template_directory() . '/inc/aal/classes/class-aal-admin-ui.php';
    $aal_ui = new AAL_Admin_Ui;
    add_action( 'admin_menu', array( $aal_ui, 'create_admin_menu' ), 20 );
  } else {
    if ($_GET['page'] === 'activity-log-settings') {
      wp_die('You do not have access');
    }
  }
  
  add_filter('dp_insert_aal', function($continue) {
    if (IS_DEV) {
      $continue = false;
    }
    return $continue;
  }, 10, 1);

  function activate_aal() {
    if (empty(get_option('activity_log_db_version'))) {
      require_once get_template_directory() . '/inc/aal/classes/class-aal-maintenance.php';
      AAL_Maintenance::activate(false);
    }
  }
  add_action( 'after_setup_theme', 'activate_aal' );
}

new Danzerpress\Twig\TwigFunctions;
new Danzerpress\Twig\TwigLoading;
new Danzerpress\Rest\RestApi;
new Danzerpress\Ajax\Ajax;
new Danzerpress\Framework\DanzerpressInterface;