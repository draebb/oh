<?php
/**
 * The default template for displaying post content in the index.php.
 *
 * @package Oh
 * @subpackage Template
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php echo esc_url( get_permalink() );  ?>" rel="bookmark">
				<?php echo get_the_title() ? get_the_title() : __( '(Untitled)', 'oh' ); ?>
			</a>
		</h1>
		<?php echo oh_entry_actions(); ?>
		<?php echo oh_entry_meta_header(); ?>
	</header>

	<?php if ( is_search() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading', 'oh' ) ); ?>
			<?php echo oh_wp_link_pages(); ?>
		</div>
	<?php endif; ?>

	<footer class="entry-footer">
		<?php echo oh_entry_meta_footer(); ?>
	</footer>
</article>
