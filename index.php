<?php
/**
 * The main template.
 *
 * @package Oh
 * @subpackage Template
 * @see http://codex.wordpress.org/Template_Hierarchy
 */
?>
<?php $tpl->extend( 'layout.php' ); ?>


<?php // block main ?>
<?php $tpl->blocks->start('main'); ?>

	<?php if ( have_posts() ) : ?>

		<?php // block page_header ?>
		<?php if ( $tpl->blocks->has( 'page_header' ) ) : ?>
			<div class="page-header">
				<?php echo $tpl->blocks->get( 'page_header' ); ?>
			</div>
		<?php endif; ?>
		<?php // end block ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content-post', 'format-' . get_post_format() ); ?>

		<?php endwhile; ?>

		<?php echo oh_page_nav(); ?>

	<?php else : ?>

		<h1 class="entry-title"><?php _e( 'Nothing Found', 'oh' ); ?></h1>

		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'oh' ); ?></p>
			<?php get_search_form(); ?>
		</div>

	<?php endif; ?>

<?php $tpl->blocks->stop(); ?>
<?php // end block ?>
