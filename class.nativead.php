<?php

class NativeAD {

	public static $autoTag = '';
	public static $dataNad = '';

	public static function init() {
		self::$dataNad = get_option( 'wp_nativead_datanad' );
		self::$autoTag = get_option( 'wp_nativead_auto_tag' );
		self::init_native_hooks();
	}

	public static function init_native_hooks() {
		// when activate plugin triggers this hook
		register_activation_hook( __FILE__, array( 'NativeAD', 'register_data' ) );
		// hook to load tag in case is required
		add_action( 'wp_enqueue_scripts', array( 'NativeAD', 'load_tag' ) );
	}

	public static function register_data() {
		if ( empty( self::$dataNad) ) {
			update_option( 'wp_nativead_datanad', md5($_SERVER['HTTP_HOST']) );
		}
		
		if ( empty( self::$autoTag ) ) {
			update_option( 'wp_nativead_auto_tag', '' );
		}
	}

	public static function load_tag() {
		if (self::$autoTag == 'on') {
			wp_enqueue_script( 'nativead-tag', 'https://files.native.ad/tag.min.js' );
		}
	}
}