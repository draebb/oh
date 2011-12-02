<?php
/**
 * This template defined a collapsible sidebars layout.
 *
 * @package Oh
 * @subpackage Template
 */


add_filter( 'body_class', 'oh_body_class_collapsible_sidebars' );
/**
 * Adds body classes for layout styling base on active sidebars.
 *
 * @package Oh
 * @subpackage Funtions
 */
function oh_body_class_collapsible_sidebars( $classes ) {
	if ( is_active_sidebar( 'sidebar-first' ) &&
	     is_active_sidebar( 'sidebar-second' )
	) {
		$classes[] = 'two-sidebars';
	} elseif ( is_active_sidebar( 'sidebar-first' ) ) {
		$classes[] = 'one-sidebar sidebar-first';
	} elseif ( is_active_sidebar( 'sidebar-second' ) ) {
		$classes[] = 'one-sidebar sidebar-second';
	} else {
		$classes[] = 'no-sidebars';
	}
	return $classes;
}
?>


<?php $tpl->extend( 'base.php' ); ?>


<?php // block content ?>
<?php $tpl->blocks->start('content'); ?>

	<div id="main" role="main">
		<?php // block main ?>
		<?php echo $tpl->blocks->get( 'main' ); ?>
		<?php // end block ?>
	</div>

	<?php if ( is_active_sidebar( 'sidebar-first' ) ) : ?>
		<aside id="sidebar-first" role="complementary">
			<?php dynamic_sidebar( 'sidebar-first' ); ?>
		</aside>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-second' ) ) : ?>
		<aside id="sidebar-second" role="complementary">
			<?php dynamic_sidebar( 'sidebar-second' ); ?>
		</aside>
	<?php endif; ?>

<?php $tpl->blocks->stop(); ?>
<?php // end block ?>
