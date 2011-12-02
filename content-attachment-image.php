<?php
/**
 * The template for displaying image content in the image.php.
 *
 * @package Oh
 * @subpackage Template
 */
?>
<?php global $post; ?>
<?php global $content_width; ?>


<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php echo oh_entry_actions(); ?>

		<ul class="entry-meta">
			<?php
			if ( $post->post_parent ) {
				$parent_url = esc_url( get_permalink( $post->post_parent ) );
				$parent_title = get_the_title( $post->post_parent );
				$parent_link_title = sprintf( __( 'Return to %s', 'oh' ), $parent_title );
				echo '<li class="meta-parent">';
				echo "In <a href='{$parent_url}' title='{$parent_link_title}' rel='gallery'>{$parent_title}</a>";
				echo '</li>';
			}
			$datetime_iso = esc_attr( get_the_date( 'c' ) );
			$date = esc_html( get_the_date() );
			echo "<li class='meta-date'><time class='published' pubdate datetime='{$datetime_iso}'>{$date}</time></li>";
			?>
		</ul>
	</div>

	<?php echo oh_image_nav(); ?>

	<div class="entry-content">
		<div class="entry-attachment">
			<?php
			$full_size_url = esc_url( wp_get_attachment_url() );
			$full_size_link_title = __( 'Link to full-size image', 'oh' );
			$image =  wp_get_attachment_image( $post->ID, array( $content_width, 1024 ) );
			echo "<a href='{$full_size_url}' title='{$full_size_link_title}'>{$image}</a>"
			?>
		</div>

		<?php if ( ! empty( $post->post_excerpt ) ) : ?>
			<div class="entry-caption">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>

		<div class="entry-description">
			<?php the_content(); ?>
		</div>
	</div>
</div>
