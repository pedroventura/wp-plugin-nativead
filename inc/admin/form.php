<?php
$dataNad = get_option( 'wp_nativead_datanad' );
$autoTag = get_option( 'wp_nativead_auto_tag' );
?>

<div class="nativead-wrapper-header">
	<span>&nbsp;</span>
	<h2>Setup NativeAD</h2>
</div>
<?php if ( isset( $_GET['settings-updated'] ) ) { ?>
<div class="wrap">
	<div id="message" class="updated">
		<p><strong><?php _e('Settings saved.') ?></strong></p>
	</div>
</div>
<?php } ?>

<div class="wrap">
	<p>Edita las opciones de integración.</p>
	<div class="postbox-container">
		<form name="nativead-form" action="admin.php?page=nativead" method="post">
			<input type="hidden" name="nativead-form" value="1">
			<div class="metabox-holder">
				<div class="postbox" style="width:100%">
					<div class="inside">
						<table class="form-table">
							<tbody>
								<tr>
									<th><label for="pgcache_prime_interval"> Hash Cliente: </label></th>
									<td>
										<input class="widefat" id="nativead-datanad" name="nativead-datanad" type="text" value="<?php echo esc_attr( $dataNad ); ?>" />
									</td>
								</tr>
								<tr>
									<th><label> Incluir Tag NativeAD: </label></th>
									<td>
										<span> <i>Selecciona esta opción si quieres incluir automaticamente el Tag JavaScript de NativeAD. (* recomendado)</i></span>
										<br />
										<input name="nativead-autoTag" type="checkbox" <?php echo $autoTag == 'on' ? 'checked' : ''; ?> >
									</td>
								</tr>
								<tr>
									<th></th>
									<td>
										<input type="submit" class="button-primary" value="<?php _e('Save'); ?>">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="postbox">
					<h3><span>Soporte y Ayuda</span></h3>
					<div class="inside">
						<table class="form-table">
							<tbody>
								<tr>
									<th>Página del plugin</th>
									<td>
										Para soporte, ayuda técnica o cualquier pregunta enviar un email a: <a href="mailto:support@native.ad">support@native.ad</a>. <br />
										También puedes ir a la documentación del plugin: <a href=" http://support.native.ad/" target="_blank">http://support.native.ad/</a> desde donde también podrás crear tickets con solicitudes de ayuda.
									</td>
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</from>
	</div>
</div>