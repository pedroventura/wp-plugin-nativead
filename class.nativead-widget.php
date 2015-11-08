<?php
/**
 * @package NativeAD
 */
class NativeAD_Widget extends WP_Widget {

	private static $dataNad = '';
	private static $autoTag = '';

	function __construct() {
		parent::__construct(
			'nativead_widget',
			'NativeAD Widget',
			array( 'description' => __( 'Set the Sidebar positionº') )
		);
		self::$dataNad = get_option( 'wp_nativead_datanad' );
		self::$autoTag = get_option( 'wp_nativead_auto_tag' );
	}

	function form( $instance ) {
		if ( $instance ) {
			$dataNad = $instance['dataNad'];
			$autoTag = $instance['autoTag'];
		}
		else {
			$dataNad = self::$dataNad;
			$autoTag = self::$autoTag;
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'dataNad' ); ?>"><?php esc_html_e( 'Hash Cliente:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'dataNad' ); ?>" name="<?php echo $this->get_field_name( 'dataNad' ); ?>" type="text" value="<?php echo esc_attr( $dataNad ); ?>" />
		<br />
		<label for="<?php echo $this->get_field_id( 'autoTag' ); ?>"><?php esc_html_e( 'Incluir Tag NativeAD:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'autoTag' ); ?>" name="<?php echo $this->get_field_name( 'autoTag' ); ?>" type="checkbox" <?php echo ($autoTag == 'on' ? 'checked' : ''); ?> />
		</p>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// actualizamos las opciones en bbdd
		update_option( 'wp_nativead_datanad', strip_tags($new_instance['dataNad']) );
		update_option( 'wp_nativead_auto_tag', strip_tags($new_instance['autoTag']) );
		// Fields
		$instance['dataNad'] = strip_tags($new_instance['dataNad']);
		$instance['autoTag'] = strip_tags($new_instance['autoTag']);
		return $instance;
	}
}

// Load Widget
function nativead_register_widgets() {
	register_widget( 'NativeAD_Widget' );
}

add_action( 'widgets_init', 'nativead_register_widgets' );
