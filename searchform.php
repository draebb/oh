<?php
/**
 * The template for displaying search forms.
 *
 * @package Oh
 * @subpackage Template
 */
?>
<form id="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<p>
		<label for="s" class="visually-hidden"><?php _e( 'Search', 'oh' ); ?></label>
		<input type="search" name="s" id="s" />
	</p>
	<p>
		<input type="submit" value="<?php esc_attr_e( 'Search', 'oh' ); ?>" />
	</p>
</form>
