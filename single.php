<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Oh
 * @subpackage Template
 * @see http://codex.wordpress.org/Template_Hierarchy
 */
?>
<?php $tpl->extend( 'layout.php' ); ?>


<?php // block main ?>
<?php $tpl->blocks->start('main'); ?>

	<?php the_post(); ?>

	<?php require locate_template( 'content-post-single.php' ); ?>

	<?php comments_template( '', true ); ?>

	<?php echo oh_singular_nav(); ?>

<?php $tpl->blocks->stop(); ?>
<?php // end block ?>
