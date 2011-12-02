<?php
/**
 * The template for displaying Category Archive pages.
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
		<?php printf( __( 'Category Archives: %s', 'oh' ), single_cat_title( '', false ) ); ?>
	</h1>

	<?php echo category_description(); ?>

<?php $tpl->blocks->stop(); ?>
<?php // end block ?>
