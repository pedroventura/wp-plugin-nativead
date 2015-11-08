<?php

/**
* NativeAD_Admin
*
* @uses     NativeAD
*
* @category Category
* @package  Package
* @author   Pedro Ventura <pedro@native.ad>
* @license  
* @link     
*/
class NativeAD_Admin extends NativeAD  {

	public static function admin_start() {
		self::admin_native_hooks();
	}

	public static function admin_native_hooks() {
		// creamos el menu el dashaboard
		add_action( 'admin_init', array( 'NativeAD_Admin', 'admin_native_init' ) );
		add_action( 'admin_menu', array( 'NativeAD_Admin', 'admin_native_menu' ), 5 );
		
		add_filter( 'plugin_action_links_' . plugin_basename( plugin_dir_path( __FILE__ ) . 'index.php'), array( 'NativeAD_Admin', 'admin_native_setting_link' ) );	
	}

	public static function admin_native_init() {
		//load_plugin_textdomain( 'natvead' ); @to-do setup idioma
		wp_register_style( 'native-admin', plugins_url('/assets/css/native-admin.css', __FILE__) );
	}

	public static function admin_native_menu() {
		// include menu on dashboard
		$page = add_menu_page( 'Setup NativeAD', 'NativeAD', 'manage_options', 'nativead', array( 'NativeAD_Admin', 'admin_native_form' ),  plugin_dir_url( __FILE__ ) . 'assets/icons/nativelogo.png' );
		// include pre-loaded styles
		add_action( 'admin_print_styles-' . $page, array( 'NativeAD_Admin', 'admin_native_styles' ) );

		if ( !empty( $_POST['nativead-form'] ) && ( $_POST['nativead-form'] == 1 ) ) {
			update_option( 'wp_nativead_datanad', $_POST['nativead-datanad']  );
			update_option( 'wp_nativead_auto_tag', $_POST['nativead-autoTag'] );
			header('Location: admin.php?page=nativead&settings-updated=true');
			exit;
		}
	}

	public static function admin_native_form() {
		require_once plugin_dir_path( __FILE__ ) . '/inc/admin/form.php';
	}

	public static function admin_native_setting_link( $links ) { 
  		$settings_link = '<a href="admin.php?page=nativead">Settings</a>'; 
  		array_unshift( $links, $settings_link ); 
  		return $links; 
	}

	public static function admin_native_styles() {
		wp_enqueue_style('native-admin');
	}
}