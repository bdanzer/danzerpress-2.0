<?php
use Roots\Sage\Setup;

/**
 * Timber
 */

class TwigSageTheme extends TimberSite {
    function __construct() {
        add_filter( 'timber_context', array( $this, 'add_to_context' ) );
        parent::__construct();
    }
    function add_to_context( $context ) {

        /* Add extra data */
        $context['foo'] = 'I am some other typical value set in your functions.php file, unrelated to the menu';

        /* Menu */
        $context['menu'] = new TimberMenu('primary_navigation');

        /* Site info */
        $context['site'] = $this;

        /* Site info */
        $context['display_sidebar'] = Setup\display_sidebar();

        $context['sidebar_primary'] = Timber::get_widgets('sidebar-primary');

        return $context;

    }
}
new TwigSageTheme();
