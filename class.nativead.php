<?php

class Native {

	public static function init() {
		self::init_hooks();
	}

	function add_action_links ( $links ) {
		$mylinks = array('<a href="' . admin_url( 'options-general.php?page=nativead' ) . '">Settings</a>');
		return array_merge( $links, $mylinks );
	}

	function register_data() {
		$dataNad = get_option( 'wp_nativead_datanad' );
		if ( empty( $dataNad) ) {
			update_option( 'wp_nativead_datanad', md5($_SERVER['HTTP_HOST']) );
		}
		// opcion para habilitar el geoip
		$autoTag = get_option( 'wp_nativead_auto_tag' );
		if ( empty( $autoTag ) ) {
			update_option( 'wp_nativead_auto_tag', 'off' );
		}
	}

	/**
	 * Initializes WordPress hooks
	 */
	private static function init_hooks() {
		add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );
		register_activation_hook( __FILE__, 'register_data' );
	}
}