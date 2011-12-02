<?php
/**
 * The template for displaying Comments.
 *
 * @package Oh
 * @subpackage Template
 */


if ( post_password_required() ) {
	return;
}
?>
<div id="comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			printf( _n( 'One thought on %2$s', '%1$s thoughts on %2$s', get_comments_number(), 'oh' ),
			        number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?>
		</h2>

		<?php echo oh_comment_nav(); ?>

		<ol class="comments-list">
			<?php
			if ( ! function_exists( 'oh_render_comment' ) ) :
			/**
			 * Renders comment. Used as a callback by wp_list_comments().
			 *
			 * @package Oh
			 * @subpackage Funtions
			 */
			function oh_render_comment( $comment, $args, $depth ) {
				$GLOBALS['comment'] = $comment; // Don't remove!
				if ( in_array( $comment->comment_type, array( 'pingback', 'trackback' ) ) ) : ?>
					<li>
						<article class="pingback">
							<?php if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) : ?>
								<div class="actions">
									<?php edit_comment_link( __( 'Edit', 'oh' ) ); ?>
								</div>
							<?php endif; ?>
							<p><?php _e( 'Pingback:', 'oh' ); ?> <?php comment_author_link(); ?></p>
						</article>
					</li>
				<?php else : ?>
					<li>
						<article id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
							<footer class="comment-footer">
								<?php echo get_avatar( $comment, 48 ); ?>

								<div class="comment-author vcard">
									<span class="fn"><?php comment_author_link() ?></span>
								</div>

								<?php
								echo sprintf( '<time class="comment-time" pubdate datetime="%1$s">%2$s</time>',
									get_comment_time( 'c' ),
									sprintf( __( '%1$s at %2$s', 'oh' ), get_comment_date(), get_comment_time() )
								);
								?>

								<?php if ( $comment->comment_approved === '0' ) : ?>
									<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'oh' ); ?></em>
								<?php endif; ?>

								<ul class="actions">
									<?php if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) : ?>
										<li><?php edit_comment_link( __( 'Edit', 'oh' ) ) ?></li>
									<?php endif; ?>
									<li>
										<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">Permalink</a>
									</li>
									<?php
									$comment_reply_link = get_comment_reply_link( array_merge( $args,
										array(
											'reply_text' => __( 'Reply', 'oh' ),
											'depth' => $depth,
											'max_depth' => $args['max_depth'] )
										) );
									if ( $comment_reply_link ) {
										echo "<li>{$comment_reply_link}</li>";
									}
									?>

								</ul>
							</footer>

							<div class="comment-content"><?php comment_text(); ?></div>

						</article>
					</li>
				<?php endif;
			}
			endif;
			wp_list_comments( array( 'callback' => 'oh_render_comment' ) );
			?>
		</ol>

		<?php echo oh_comment_nav(); ?>
	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="comments-closed"><?php _e( 'Comments are closed.', 'oh' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div>
