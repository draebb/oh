<?php
/**
 * The template for displaying image attachments.
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

	<?php require locate_template( 'content-attachment-image.php' ); ?>

	<?php comments_template( '', true ); ?>

<?php $tpl->blocks->stop(); ?>
<?php // end block ?>
