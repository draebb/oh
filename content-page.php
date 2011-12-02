<?php
/**
 * The template for displaying page content in the page.php.
 *
 * @package Oh
 * @subpackage Template
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php echo oh_entry_actions(); ?>
	</div>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php echo oh_wp_link_pages(); ?>
	</div>
</div>
