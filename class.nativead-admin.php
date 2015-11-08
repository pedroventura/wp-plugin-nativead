<?php

class NativeAD_Admin {


	public static function init() {
		self::init_admin_hooks();
	}

	public static function init_admin_hooks() {
		// creamos el menu el dashaboard
		add_action( 'admin_init', array( 'NativeAD_Admin', 'admin_init' ) );
		add_action( 'admin_menu', array( 'NativeAD_Admin', 'admin_menu' ), 5 );
		
		add_filter( 'plugin_action_links_' . plugin_basename( plugin_dir_path( __FILE__ ) . 'index.php'), array( 'NativeAD_Admin', 'admin_plugin_settings_link' ) );	
	}

	public static function admin_init() {
		//load_plugin_textdomain( 'natvead' ); @to-do setup idioma
		wp_register_style( 'native-admin', plugins_url('/assets/css/native-admin.css', __FILE__) );
	}

	public static function admin_menu() {
		// include menu on dashboard
		$page = add_menu_page( 'Setup NativeAD', 'NativeAD', 'manage_options', 'nativead', array( 'NativeAD_Admin', 'display_page' ),  plugin_dir_url( __FILE__ ) . 'assets/icons/nativelogo.png' );
		// include pre-loaded styles
		add_action( 'admin_print_styles-' . $page, array( 'NativeAD_Admin', 'include_styles' ) );

		if ( !empty( $_POST['nativead-form'] ) && ( $_POST['nativead-form'] == 1 ) ) {
			update_option( 'wp_nativead_datanad', $_POST['nativead-datanad']  );
			update_option( 'wp_nativead_auto_tag', $_POST['nativead-autoTag'] );
			header('Location: admin.php?page=nativead&settings-updated=true');
			exit;
		}
	}

	public static function display_page() {
		require_once plugin_dir_path( __FILE__ ) . '/inc/admin/form.php';
	}

	public static function admin_plugin_settings_link( $links ) { 
  		$settings_link = '<a href="admin.php?page=nativead">Settings</a>'; 
  		array_unshift( $links, $settings_link ); 
  		return $links; 
	}

	public static function include_styles() {
		wp_enqueue_style('native-admin');
	}
}