<?php
/**
 * The template for displaying content in the single.php.
 *
 * @package Oh
 * @subpackage Template
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php echo oh_entry_actions(); ?>
		<?php echo oh_entry_meta_header(); ?>
	</div>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php echo oh_wp_link_pages(); ?>
	</div>

	<div class="entry-footer">
		<?php echo oh_entry_meta_footer(); ?>

		<?php if ( get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
		<div class="author-info">
			<?php
			$author_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
			$author_link_title = sprintf( esc_attr__( 'View all posts by %s', 'oh' ), get_the_author() );
			$author_name = esc_html( get_the_author() );
			$author = "<a href='{$author_url}' title='{$author_link_title}' rel='author'>{$author_name}</a>"
			?>
			<h2 class="author-info-title"><?php printf( esc_attr__( 'About %s', 'oh' ), $author ); ?></h2>
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 120 ); ?>
			<div class="author-info-description">
				<?php echo wpautop(get_the_author_meta( 'description' )); ?>
			</div>
		</div><!-- .author-info -->
		<?php endif; ?>
	</div>
</div>
