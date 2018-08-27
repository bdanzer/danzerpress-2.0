<?php

class AAL_Admin_Ui {

	/**
	 * @var AAL_Activity_Log_List_Table
	 */
	protected $_list_table = null;
	
	protected $_screens = array();

	public function create_admin_menu() {
		$menu_capability = current_user_can( 'view_all_aryo_activity_log' ) ? 'view_all_aryo_activity_log' : 'edit_pages';
		
		$this->_screens['main'] = add_menu_page( _x( 'Activity Log', 'Page and Menu Title', 'aryo-activity-log' ), _x( 'Activity Log', 'Page and Menu Title', 'aryo-activity-log' ), $menu_capability, 'activity_log_page', array( &$this, 'activity_log_page_func' ), '', '2.1' );
		
		// Just make sure we are create instance.
		add_action( 'load-' . $this->_screens['main'], array( &$this, 'get_list_table' ) );
	}

	public function activity_log_page_func() {
		$this->get_list_table()->prepare_items();
		?>
		<div class="wrap">
			<h1 class="aal-page-title"><?php _ex( 'Activity Log', 'Page and Menu Title', 'aryo-activity-log' ); ?></h1>

			<form id="activity-filter" method="get">
				<input type="hidden" name="page" value="<?php echo esc_attr( $_REQUEST['page'] ); ?>" />
				<?php $this->get_list_table()->display(); ?>
			</form>
		</div>
		
		<?php // TODO: move to a separate file. ?>
		<style>
			#record-actions-submit {
				margin-top: 10px;
			}
			.aal-pt {
				color: #ffffff;
				padding: 1px 4px;
				margin: 0 5px;
				font-size: 1em;
				border-radius: 3px;
				background: #808080;
				font-family: inherit;
			}
			.toplevel_page_activity_log_page .manage-column {
				width: auto;
			}
			.toplevel_page_activity_log_page .column-description {
				width: 20%;
			}
			#adminmenu #toplevel_page_activity_log_page div.wp-menu-image:before {
				content: "\f321";
			}
			@media (max-width: 767px) {
				.toplevel_page_activity_log_page .manage-column {
					width: auto;
				}
				.toplevel_page_activity_log_page .column-date,
				.toplevel_page_activity_log_page .column-author {
					display: table-cell;
					width: auto;
				}
				.toplevel_page_activity_log_page .column-ip,
				.toplevel_page_activity_log_page .column-description,
				.toplevel_page_activity_log_page .column-label {
					display: none;
				}
				.toplevel_page_activity_log_page .column-author .avatar {
					display: none;
				}
			}
		</style>
		<?php
	}
	
	public function admin_header() {
		// TODO: move to a separate file.
		?><style>
			#adminmenu #toplevel_page_activity_log_page div.wp-menu-image:before {
				content: "\f321";
			}
		</style>
	<?php
	}
	
	public function ajax_aal_install_elementor_set_admin_notice_viewed() {
		update_user_meta( get_current_user_id(), '_aal_elementor_install_notice', 'true' );
	}

	public function print_js() {
		?>
		<script>jQuery( function( $ ) {
				$( 'div.notice.aal-install-elementor' ).on( 'click', 'button.notice-dismiss', function( event ) {
					event.preventDefault();

					$.post( ajaxurl, {
						action: 'aal_install_elementor_set_admin_notice_viewed'
					} );
				} );
			} );</script>
		<?php
	}
	
	public function __construct() {
		add_action( 'admin_head', array( &$this, 'admin_header' ) );
		add_action( 'wp_ajax_aal_install_elementor_set_admin_notice_viewed', array( &$this, 'ajax_aal_install_elementor_set_admin_notice_viewed' ) );
	}
	
	private function _is_elementor_installed() {
		$file_path = 'elementor/elementor.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
	}

	/**
	 * @return AAL_Activity_Log_List_Table
	 */
	public function get_list_table() {
		if ( is_null( $this->_list_table ) ) {
			$this->_list_table = new AAL_Activity_Log_List_Table( array( 'screen' => $this->_screens['main'] ) );
			do_action( 'aal_admin_page_load', $this->_list_table );
		}
		
		return $this->_list_table;
	}
}
