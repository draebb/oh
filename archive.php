<?php
/**
 * The template for displaying Archive pages.
 *
 * @package Oh
 * @subpackage Template
 * @see http://codex.wordpress.org/Template_Hierarchy
 */
?>
<?php $tpl->extend( 'index.php' ); ?>


<?php // block page_header ?>
<?php $tpl->blocks->start('page_header'); ?>

	<h1 class="page-title">
		<?php if ( is_day() ) : ?>
			<?php printf( __( 'Daily Archives: %s', 'oh' ), get_the_date() ); ?>
		<?php elseif ( is_month() ) : ?>
			<?php printf( __( 'Monthly Archives: %s', 'oh' ), get_the_date( 'F Y' ) ); ?>
		<?php elseif ( is_year() ) : ?>
			<?php printf( __( 'Yearly Archives: %s', 'oh' ), get_the_date( 'Y' ) ); ?>
		<?php else : ?>
			<?php _e( 'Blog Archives', 'oh' ); ?>
		<?php endif; ?>
	</h1>

<?php $tpl->blocks->stop(); ?>
<?php // end block ?>
