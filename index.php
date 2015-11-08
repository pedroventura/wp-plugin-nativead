<?php
/**
 * Plugin Name: NativeAD for WordPress
 * Plugin URI: http://native.ad
 * Description: This plugins provide the functionality to serve native ads on your blog.
 * Version: 0.0.1
 * Author: Pedro Ventura
 * Author URI: http://native.ad
 * License: GPL2
 */

define( 'NATIVEAD__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once( NATIVEAD__PLUGIN_DIR . 'class.nativead.php' );
require_once( NATIVEAD__PLUGIN_DIR . 'class.nativead-widget.php' );

add_action( 'init', array( 'Native', 'init' ) );

if ( is_admin() ) {
	require_once( NATIVEAD__PLUGIN_DIR . 'class.nativead-admin.php' );
	add_action( 'init', array( 'NativeAD_Admin', 'init' ) );
}