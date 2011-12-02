<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package Oh
 * @subpackage Template
 * @see http://codex.wordpress.org/Template_Hierarchy
 */
?>
<?php $tpl->extend( 'index.php' ); ?>


<?php // block page_header ?>
<?php $tpl->blocks->start('page_header'); ?>

	<?php
		/* Queue the first post, that way we know
		 * what author we're dealing with (if that is the case).
		 *
		 * We reset this later so we can run the loop
		 * properly with a call to rewind_posts().
		 */
		the_post();
	?>

	<h1 class="page-title">
		<?php printf( __( 'Author Archives: %s', 'oh' ), get_the_author() ); ?>
	</h1>

	<?php
		/* Since we called the_post() above, we need to
		 * rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */
		rewind_posts();
	?>

	<?php
	// If a user has filled out their description, show a bio on their entries.
	if ( get_the_author_meta( 'description' ) ) : ?>
		<div class="author-info">
			<h2 class="author-info-title"><?php printf( __( 'About %s', 'oh' ), get_the_author() ); ?></h2>
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 120 ); ?>
			<div class="author-info-description">
				<?php echo wpautop(get_the_author_meta( 'description' )); ?>
			</div>
		</div>
	<?php endif; ?>

<?php $tpl->blocks->stop(); ?>
<?php // end block ?>
