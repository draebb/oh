<?php
/**
 * The template for displaying Search Results pages.
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
		<?php printf( __( 'Search Results for: %s', 'oh' ), get_search_query() ); ?>
	</h1>

<?php $tpl->blocks->stop(); ?>
<?php // end block ?>
