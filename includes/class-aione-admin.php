<?php
/**
 * A class to manage various stuff in the WordPress admin area.
 *
 * @package Aione
 * @subpackage Includes
 * @since 3.8.0
 */
class Aione_Admin {

	/**
	 * Construct the admin object.
	 *
	 * @since 3.9.0
	 *
	 */
	public function __construct() {
		//add_action( 'wp_before_admin_bar_render', array( $this, 'aione_add_wp_toolbar_menu' ) );
		add_action( 'admin_init', array( $this, 'aione_admin_init' ) );
		add_action( 'admin_init', array( $this, 'init_permalink_settings' ) );
		add_action( 'admin_init', array( $this, 'save_permalink_settings' ) );
		add_action( 'admin_menu', array( $this, 'aione_admin_menu' ) );
		add_action( 'admin_head', array( $this, 'aione_admin_scripts' ) );
		add_action( 'admin_menu', array( $this, 'edit_admin_menus' ) );
		//add_action( 'after_switch_theme', array( $this, 'aione_activation_redirect' ) );
		//add_action( 'wp_ajax_aione_update_registration', array( $this, 'aione_update_registration' ) );	
		//add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widget' ) );
	}

	/**
	 * Adds the news dashboard widget.
	 *
	 * @since 3.9.0
	 */
	public function add_dashboard_widget() {
		// Create the widget
		wp_add_dashboard_widget( 'themeoxo_news', apply_filters( 'aione_dashboard_widget_title', __( 'OXOSolutions News', 'Aione' ) ), array( $this, 'display_news_dashboard_widget' ) );
		
 		// Make sure our widget is on top off all others
		global $wp_meta_boxes;

		// Get the regular dashboard widgets array 
		$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

		// Backup and delete our new dashboard widget from the end of the array
		$aione_widget_backup = array( 'themeoxo_news' => $normal_dashboard['themeoxo_news'] );
		unset( $normal_dashboard['themeoxo_news'] );

		// Merge the two arrays together so our widget is at the beginning
		$sorted_dashboard = array_merge( $aione_widget_backup, $normal_dashboard );

		// Save the sorted array back into the original metaboxes
		$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
	}

	/**
	 * Renders the news dashboard widget.
	 *
	 * @since 3.9.0
	 */
	public function display_news_dashboard_widget() {
	
		// Create two feeds, the first being just a leading article with data and summary, the second being a normal news feed
		$feeds = array(
			$first = array(
				'link' 			=> 'https://oxosolutions.com/blog/',
				'url' 			=> 'https://oxosolutions.com/feed/',
				'title' 		=> __( 'OXOSolutions News', 'Aione' ),
				'items' 		=> 1,
				'show_summary' 	=> 1,
				'show_author' 	=> 0,
				'show_date' 	=> 1
			),

			$news = array(
				'link' 			=> 'https://oxosolutions.com/blog/',
				'url' 			=> 'https://oxosolutions.com/feed/',  
				'title' 		=> __( 'OXOSolutions News', 'Aione' ),
				'items' 		=> 4,
				'show_summary' 	=> 0,
				'show_author' 	=> 0,
				'show_date' 	=> 0
			)
		);

		wp_dashboard_primary_output( 'themeoxo_news', $feeds );
	}
	
	/**
	 * Create the admin toolbar menu items.
	 *
	 * @since 3.8.0	 
	 */
	function aione_add_wp_toolbar_menu() {

		global $wp_admin_bar;

		if ( current_user_can( 'edit_theme_options' ) ) {

			$registration_complete = FALSE;
			$aione_options         = get_option( 'Aione_Key' );
			$tf_username           = isset( $aione_options['tf_username'] ) ? $aione_options['tf_username'] : '';
			$tf_api                = isset( $aione_options['tf_api'] ) ? $aione_options['tf_api'] : '';
			$tf_purchase_code      = isset( $aione_options['tf_purchase_code'] ) ? $aione_options['tf_purchase_code'] : '';
			if ( '' !== $tf_username && '' !== $tf_api && '' !== $tf_purchase_code ) {
				$registration_complete = TRUE;
			}
			$aione_parent_menu_title = '<span class="ab-icon"></span><span class="ab-label">Aione</span>';

			$this->aione_add_wp_toolbar_menu_item( $aione_parent_menu_title, FALSE, admin_url( 'admin.php?page=aione' ), array( 'class' => 'aione-menu' ), 'aione' );

			if ( ! $registration_complete ) {
				$this->aione_add_wp_toolbar_menu_item( __( 'Product Registration', 'Aione' ), 'aione', admin_url( 'admin.php?page=aione' ) );
			}
			$this->aione_add_wp_toolbar_menu_item( __( 'Support', 'Aione' ), 'aione', admin_url( 'admin.php?page=aione-support' ) );
			$this->aione_add_wp_toolbar_menu_item( __( 'Install Demos', 'Aione' ), 'aione', admin_url( 'admin.php?page=aione-demos' ) );
			$this->aione_add_wp_toolbar_menu_item( __( 'Plugins', 'Aione' ), 'aione', admin_url( 'admin.php?page=aione-plugins' ) );
			$this->aione_add_wp_toolbar_menu_item( __( 'System Status', 'Aione' ), 'aione', admin_url( 'admin.php?page=aione-system-status' ) );
			$this->aione_add_wp_toolbar_menu_item( __( 'Theme Options', 'Aione' ), 'aione', admin_url( 'themes.php?page=optionsframework' ) );

		}

	}

	/**
	 * Add the top-level menu item to the adminbar.
	 *
	 * @since 3.8.0	 
	 */
	function aione_add_wp_toolbar_menu_item( $title, $parent = FALSE, $href = '', $custom_meta = array(), $custom_id = '' ) {

		global $wp_admin_bar;

		if ( current_user_can( 'edit_theme_options' ) ) {
			if ( ! is_super_admin() || ! is_admin_bar_showing() ) {
				return;
			}

			// Set custom ID
			if ( $custom_id ) {
				$id = $custom_id;
			// Generate ID based on $title
			} else {
				$id = strtolower( str_replace( ' ', '-', $title ) );
			}

			// links from the current host will open in the current window
			$meta = strpos( $href, site_url() ) !== false ? array() : array( 'target' => '_blank' ); // external links open in new tab/window
			$meta = array_merge( $meta, $custom_meta );

			$wp_admin_bar->add_node( array(
				'parent' => $parent,
				'id'     => $id,
				'title'  => $title,
				'href'   => $href,
				'meta'   => $meta,
			) );
		}

	}

	/**
	 * Modify the menu
	 *
	 * @since 3.8.0	 
	 */
	function edit_admin_menus() {
		global $submenu;

		if ( current_user_can( 'edit_theme_options' ) ) {
			$submenu['aione'][0][0] = __( 'Product Registration', 'Aione' ); // Change Aione to Product Registration
		}
	}

	/**
	 * Redirect to admin page on theme activation
	 *
	 * @since 3.8.0	 
	 */
	function aione_activation_redirect() {
		if ( current_user_can( 'edit_theme_options' ) ) {
			header( 'Location:' . admin_url() . 'admin.php?page=aione' );
		}
	}

	/**
	 * Actions to run on initial theme activation
	 *
	 * @since 3.8.0	 
	 */
	function aione_admin_init() {

		if ( current_user_can( 'edit_theme_options' ) ) {
			// Save aione key in a different location
			$aione_key = get_option( 'Aione_Key' );
			if ( ! is_array( $aione_key ) && empty( $aione_key ) ) {
				$aione_options    = get_option( 'Aione_options' );
				$tf_username      = isset( $aione_options['tf_username'] ) ? $aione_options['tf_username'] : '';
				$tf_api           = isset( $aione_options['tf_api'] ) ? $aione_options['tf_api'] : '';
				$tf_purchase_code = isset( $aione_options['tf_purchase_code'] ) ? $aione_options['tf_purchase_code'] : '';

				if ( $tf_username && $tf_api && $tf_purchase_code ) {
					update_option( 'Aione_Key', array(
						'tf_username' 		=> $tf_username,
						'tf_api'	  		=> $tf_api,
						'tf_purchase_code'	=> $tf_purchase_code
					));
				}
			}

			if ( isset( $_GET['aione-deactivate'] ) && $_GET['aione-deactivate'] == 'deactivate-plugin' ) {
				check_admin_referer( 'aione-deactivate', 'aione-deactivate-nonce' );

				$plugins = TGM_Plugin_Activation::$instance->plugins;

				foreach( $plugins as $plugin ) {
					if ( $plugin['slug'] == $_GET['plugin'] ) {
						deactivate_plugins( $plugin['file_path'] );
					}
				}
			} if ( isset( $_GET['aione-activate'] ) && $_GET['aione-activate'] == 'activate-plugin' ) {
				check_admin_referer( 'aione-activate', 'aione-activate-nonce' );

				$plugins = TGM_Plugin_Activation::$instance->plugins;

				foreach( $plugins as $plugin ) {
					if ( $plugin['slug'] == $_GET['plugin'] ) {
						activate_plugin( $plugin['file_path'] );

						wp_redirect( admin_url( 'admin.php?page=aione-plugins' ) );
						exit;
					}
				}
			}
		}
	}

	function aione_admin_menu(){

		if ( current_user_can( 'edit_theme_options' ) ) {
			// Work around for theme check
			$aione_menu_page_creation_method    = 'add_menu_page';
			$aione_submenu_page_creation_method = 'add_submenu_page';

			$welcome_screen = $aione_menu_page_creation_method( 'Aione', 'Aione', 'administrator', 'aione', array( $this, 'aione_welcome_screen' ), 'dashicons-oxoa-logo', 59 );

			$support        = $aione_submenu_page_creation_method( 'aione', __( 'Aione Support', 'Aione' ), __( 'Support', 'Aione' ), 'administrator', 'aione-support', array( $this, 'aione_support_tab' ) );
			$demos          = $aione_submenu_page_creation_method( 'aione', __( 'Install Aione Demos', 'Aione' ), __( 'Install Demos', 'Aione' ), 'administrator', 'aione-demos', array( $this, 'aione_demos_tab' ) );
			$plugins        = $aione_submenu_page_creation_method( 'aione', __( 'Plugins', 'Aione' ), __( 'Plugins', 'Aione' ), 'administrator', 'aione-plugins', array( $this, 'aione_plugins_tab' ) );
			$status         = $aione_submenu_page_creation_method( 'aione', __( 'System Status', 'Aione' ), __( 'System Status', 'Aione' ), 'administrator', 'aione-system-status', array( $this, 'aione_system_status_tab' ) );
			$theme_options  = $aione_submenu_page_creation_method( 'aione', __( 'Theme Options', 'Aione' ), __( 'Theme Options', 'Aione' ), 'administrator', 'themes.php?page=optionsframework' );

			add_action( 'admin_print_scripts-'.$welcome_screen, array( $this, 'welcome_screen_scripts' ) );
			add_action( 'admin_print_scripts-'.$support, array( $this, 'support_screen_scripts' ) );
			add_action( 'admin_print_scripts-'.$demos, array( $this, 'demos_screen_scripts' ) );
			add_action( 'admin_print_scripts-'.$plugins, array( $this, 'plugins_screen_scripts' ) );
			add_action( 'admin_print_scripts-'.$status, array( $this, 'status_screen_scripts' ) );
		}
	}

	function aione_welcome_screen() {
		require_once( 'admin-screens/welcome.php' );
	}

	function aione_support_tab() {
		require_once( 'admin-screens/support.php' );
	}

	function aione_demos_tab() {
		require_once( 'admin-screens/install-demos.php' );
	}

	function aione_plugins_tab() {
		require_once( 'admin-screens/oxo-plugins.php' );
	}

	function aione_system_status_tab() {
		require_once( 'admin-screens/system-status.php' );
	}

	function aione_update_registration() {

		global $wp_version;

		$aione_options    = get_option( 'Aione_Key' );
		$data             = $_POST;
		$tf_username      = isset( $data['tf_username'] ) ? $data['tf_username'] : '';
		$tf_api           = isset( $data['tf_api'] ) ? $data['tf_api'] : '';
		$tf_purchase_code = isset( $data['tf_purchase_code'] ) ? $data['tf_purchase_code'] : '';

		if ( '' !== $tf_username && '' !== $tf_api && '' !== $tf_purchase_code ) {

			$aione_options['tf_username']      = $tf_username;
			$aione_options['tf_api']           = $tf_api;
			$aione_options['tf_purchase_code'] = $tf_purchase_code;

			$prepare_request = array(
				'user-agent' => 'WordPress/'. $wp_version .'; '. home_url()
			);

			$raw_response = wp_remote_post( 'http://marketplace.envato.com/api/v3/' . $tf_username . '/' . $tf_api . '/download-purchase:' . $tf_purchase_code . '.json', $prepare_request );

			if ( ! is_wp_error( $raw_response ) ) {
				$response = json_decode( $raw_response['body'], true );
			}

			if ( ! empty( $response ) ) {

				if ( ( isset( $response['error'] ) ) || ( isset( $response['download-purchase'] ) && empty( $response['download-purchase'] ) ) ) {
					echo 'Error';
				} elseif ( isset( $response['download-purchase'] ) && ! empty( $response['download-purchase'] ) ) {
					$result = update_option( 'Aione_Key', $aione_options );
					echo 'Updated';
				}

			} else {

				echo 'Error';

			}

		} else {
			echo 'Empty';
		}

		die();

	}

	function aione_admin_scripts() {
		if ( is_admin() && current_user_can( 'edit_theme_options' ) ) {
		?>
		<style type="text/css">
		@media screen and (max-width: 782px) {
			#wp-toolbar > ul > .aione-menu {
				display: block;
			}

			#wpadminbar .aione-menu > .ab-item .ab-icon {
				padding-top: 6px !important;
				height: 40px !important;
				font-size: 30px !important;
			}
		}
		/*
		#menu-appearance a[href="themes.php?page=optionsframework"] {
			display: none;
		}
		*/
		#wpadminbar .aione-menu > .ab-item .ab-icon:before,
		.dashicons-oxoa-logo:before{
			content: "\e62d";
			font-family: 'icomoon';
			speak: none;
			font-style: normal;
			font-weight: normal;
			font-variant: normal;
			text-transform: none;
			line-height: 1;

			/* Better Font Rendering =========== */
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
		</style>
		<?php
		}
	}

	function welcome_screen_scripts(){
		wp_enqueue_style( 'aione_admin_css', Aione()->get_framework_dir() . '/assets/css/aione-admin.css' );
		wp_enqueue_style( 'welcome_screen_css', Aione()->get_framework_dir() . '/assets/css/aione-welcome-screen.css' );
		wp_enqueue_script( 'aione_welcome_screen', Aione()->get_framework_dir() . '/assets/js/aione-welcome-screen.js' );
	}

	function support_screen_scripts(){
		wp_enqueue_style( 'aione_admin_css', Aione()->get_framework_dir() . '/assets/css/aione-admin.css' );
	}

	function demos_screen_scripts(){
		wp_enqueue_style( 'aione_admin_css', Aione()->get_framework_dir() . '/assets/css/aione-admin.css' );
		wp_enqueue_script( 'aione_admin_js', Aione()->get_framework_dir() . '/assets/js/aione-admin.js' );
	}

	function plugins_screen_scripts(){
		wp_enqueue_style( 'aione_admin_css', Aione()->get_framework_dir() . '/assets/css/aione-admin.css' );
	}

	function status_screen_scripts(){
		wp_enqueue_style( 'aione_admin_css', Aione()->get_framework_dir() . '/assets/css/aione-admin.css' );
		wp_enqueue_script( 'aione_admin_js', Aione()->get_framework_dir() . '/assets/js/aione-admin.js' );
	}

	function plugin_link( $item ) {
		$installed_plugins = get_plugins();

		$item['sanitized_plugin'] = $item['name'];

		// We have a repo plugin
		if ( ! $item['version'] ) {
			$item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
		}

		/** We need to display the 'Install' hover link */
		if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
			$actions = array(
				'install' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Install %2$s">Install</a>',
					esc_url( wp_nonce_url(
						add_query_arg(
							array(
								'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'        => urlencode( $item['slug'] ),
								'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
								'plugin_source' => urlencode( $item['source'] ),
								'tgmpa-install' => 'install-plugin',
								'return_url'    => 'oxo_plugins'
							),
							TGM_Plugin_Activation::$instance->get_tgmpa_url()
						),
						'tgmpa-install',
						'tgmpa-nonce'
					) ),
					$item['sanitized_plugin']
				),
			);
		}
		/** We need to display the 'Activate' hover link */
		elseif ( is_plugin_inactive( $item['file_path'] ) ) {
			$actions = array(
				'activate' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
					esc_url( add_query_arg(
						array(
							'plugin'               => urlencode( $item['slug'] ),
							'plugin_name'          => urlencode( $item['sanitized_plugin'] ),
							'plugin_source'        => urlencode( $item['source'] ),
							'aione-activate'       => 'activate-plugin',
							'aione-activate-nonce' => wp_create_nonce( 'aione-activate' ),
						),
						admin_url( 'admin.php?page=aione-plugins' )
					) ),
					$item['sanitized_plugin']
				),
			);
		}
		/** We need to display the 'Update' hover link */
		elseif ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) ) {
			$actions = array(
				'update' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Install %2$s">Update</a>',
					wp_nonce_url(
						add_query_arg(
							array(
								'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'        => urlencode( $item['slug'] ),

								'tgmpa-update'  => 'update-plugin',
								'plugin_source' => urlencode( $item['source'] ),
								'version'       => urlencode( $item['version'] ),
								'return_url'    => 'oxo_plugins'
							),
							TGM_Plugin_Activation::$instance->get_tgmpa_url()
						),
						'tgmpa-update',
						'tgmpa-nonce'
					),
					$item['sanitized_plugin']
				),
			);
		} elseif ( is_plugin_active( $item['file_path'] ) ) {
			$actions = array(
				'deactivate' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Deactivate %2$s">Deactivate</a>',
					esc_url( add_query_arg(
						array(
							'plugin'                 => urlencode( $item['slug'] ),
							'plugin_name'            => urlencode( $item['sanitized_plugin'] ),
							'plugin_source'          => urlencode( $item['source'] ),
							'aione-deactivate'       => 'deactivate-plugin',
							'aione-deactivate-nonce' => wp_create_nonce( 'aione-deactivate' ),
						),
						admin_url( 'admin.php?page=aione-plugins' )
					) ),
					$item['sanitized_plugin']
				),
			);
		}

		return $actions;
	}

	/**
	 * let_to_num function.
	 *
	 * This function transforms the php.ini notation for numbers (like '2M') to an integer.
	 *
	 * @since 3.8.0
	 *
	 * @param $size
	 * @return int
	 */
	function let_to_num( $size ) {
		$l   = substr( $size, -1 );
		$ret = substr( $size, 0, -1 );
		switch ( strtoupper( $l ) ) {
			case 'P':
				$ret *= 1024;
			case 'T':
				$ret *= 1024;
			case 'G':
				$ret *= 1024;
			case 'M':
				$ret *= 1024;
			case 'K':
				$ret *= 1024;
		}
		return $ret;
	}
	
	/**
	 * Initialize the permalink settings.
	 * @since 3.9.2
	 */
	public function init_permalink_settings() {
		add_settings_field(
			'aione_portfolio_category_slug',            		// id
			__( 'Aione portfolio category base', 'Aione' ), 	// setting title
			array( $this, 'permalink_slug_input',  ),			// display callback
			'permalink',                                    	// settings page
			'optional',                                      	// settings section
			array( 'taxonomy' => 'portfolio_category' )			// args
		);
		
		add_settings_field(
			'aione_portfolio_skills_slug',
			__( 'Aione portfolio skill base', 'Aione' ), 
			array( $this, 'permalink_slug_input' ),	
			'permalink',                                    	
			'optional',
			array( 'taxonomy' => 'portfolio_skills' )
		);
		
		add_settings_field(
			'aione_portfolio_tag_slug',
			__( 'Aione portfolio tag base', 'Aione' ),
			array( $this, 'permalink_slug_input' ),
			'permalink',
			'optional',
			array( 'taxonomy' => 'portfolio_tags' )
		);		
	}

	/**
	 * Show a slug input box.
	 * @since 3.9.2	 
	 */
	public function permalink_slug_input( $args ) {
		$permalinks = get_option( 'aione_permalinks' );
		$permalink_base = $args['taxonomy'] . '_base';
		$input_name = 'aione_' . $args['taxonomy'] . '_slug';
		$placeholder = $args['taxonomy'];
		?>
		<input name="<?php echo $input_name; ?>" type="text" class="regular-text code" value="<?php if ( isset( $permalinks[$permalink_base] ) ) echo esc_attr( $permalinks[$permalink_base] ); ?>" placeholder="<?php echo esc_attr_x( $placeholder, 'slug', 'Aione' ) ?>" />
		<?php
	}
	
	/**
	 * Save the permalink settings.
	 * @since 3.9.2	 
	 */
	public function save_permalink_settings() {

		if ( ! is_admin() ) {
			return;
		}

		if ( isset( $_POST['permalink_structure'] ) || isset( $_POST['category_base'] ) ) {
			// Cat and tag bases
			$portfolio_category_slug	= ( isset( $_POST['aione_portfolio_category_slug'] ) ) ? sanitize_text_field( $_POST['aione_portfolio_category_slug'] ) : '';
			$portfolio_skills_slug		= ( isset( $_POST['aione_portfolio_skills_slug'] ) ) ? sanitize_text_field( $_POST['aione_portfolio_skills_slug'] ) : '';
			$portfolio_tags_slug		= ( isset( $_POST['aione_portfolio_tags_slug'] ) ) ? sanitize_text_field( $_POST['aione_portfolio_tags_slug'] ) : '';

			$permalinks = get_option( 'aione_permalinks' );

			if ( ! $permalinks ) {
				$permalinks = array();
			}

			$permalinks['portfolio_category_base']	= untrailingslashit( $portfolio_category_slug );
			$permalinks['portfolio_skills_base']	= untrailingslashit( $portfolio_skills_slug );
			$permalinks['portfolio_tags_base']		= untrailingslashit( $portfolio_tags_slug );

			update_option( 'aione_permalinks', $permalinks );
		}
	}	
}

// Omit closing PHP tag to avoid "Headers already sent" issues.