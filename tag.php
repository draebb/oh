<?php
/**
 * The template used to display Tag Archive pages
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
		<?php printf( __( 'Tag Archives: %s', 'oh' ), single_tag_title( '', false ) ); ?>
	</h1>

	<?php echo tag_description(); ?>

<?php $tpl->blocks->stop(); ?>
<?php // end block ?>
