<?php

class Native {

	public static function init() {
		self::init_native_hooks();
	}

	public static function init_native_hooks() {
		register_activation_hook( __FILE__, array( 'Native', 'register_data' ) );
	}

	public static function register_data() {
		$dataNad = get_option( 'wp_nativead_datanad' );
		if ( empty( $dataNad) ) {
			update_option( 'wp_nativead_datanad', md5($_SERVER['HTTP_HOST']) );
		}
		// opcion para habilitar el geoip
		$autoTag = get_option( 'wp_nativead_auto_tag' );
		if ( empty( $autoTag ) ) {
			update_option( 'wp_nativead_auto_tag', '' );
		}
	}
}