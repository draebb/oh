<?php
/**
 * Template helpers.
 *
 * @package Oh
 * @subpackage Template Helpers
 */


if ( ! function_exists( 'oh_singular_nav' ) ) :
/**
 * Returns HTML of navigation to the next/previous posts.
 *
 * @return string
 */
function oh_singular_nav() {
	ob_start();
	next_post_link( '%link', __( 'Newer post', 'oh' ) );
	$next_post_link = ob_get_clean();

	ob_start();
	previous_post_link( '%link', __( 'Older post', 'oh' ) );
	$previous_post_link = ob_get_clean();

	return oh_build_nav( array(
		'heading' => __( 'Post navigation', 'oh' ),
		'first' => $next_post_link,
		'last' => $previous_post_link
	) );
}
endif;


if ( ! function_exists( 'oh_image_nav' ) ) :
/**
 * Returns HTML of navigation to next/previous images.
 *
 * @return string
 */
function oh_image_nav() {
	ob_start();
	previous_image_link( false, __( 'Previous' , 'oh' ) );
	$previous_image_link = ob_get_clean();

	ob_start();
	next_image_link( false, __( 'Next' , 'oh' ) );
	$next_image_link = ob_get_clean();

	return oh_build_nav( array(
		'heading' => __( 'Image navigation', 'oh' ),
		'first' => $previous_image_link,
		'last' => $next_image_link
	) );
}
endif;


if ( ! function_exists( 'oh_page_nav' ) ) :
/**
 * Returns HTML of navigation to the next/previous pages.
 *
 * @return string
 */
function oh_page_nav() {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) {
		return oh_build_nav( array(
			'heading' => __( 'Post navigation', 'oh' ),
			'first' => get_previous_posts_link( __( 'Newer posts', 'oh' ) ),
			'last' => get_next_posts_link( __( 'Older posts', 'oh' ) )
		) );
	}
}
endif;


if ( ! function_exists( 'oh_comment_nav' ) ) :
/**
 * Returns HTML of navigation to the next/previous pages of comments.
 *
 * @return string
 */
function oh_comment_nav() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
		ob_start();
		previous_comments_link( __( 'Older Comments', 'oh' ) );
		$previous_comments_link = ob_get_clean();

		ob_start();
		next_comments_link( __( 'Newer Comments', 'oh' ) );
		$next_comments_link = ob_get_clean();

		return oh_build_nav( array(
			'heading' => __( 'Comment navigation', 'oh' ),
			'first' => $previous_comments_link,
			'last' => $next_comments_link
		) );
	}
}
endif;

if ( ! function_exists( 'oh_build_nav' ) ) :
/**
 * Builds HTML of next/previous navigation.
 *
 * @param array $args The arguments array
 *
 * @return string
 */
function oh_build_nav( $args ) {
	ob_start();
	?>
	<nav class="nav">
		<h2 class="visually-hidden"><?php echo $args['heading']; ?></h2>
		<span class="nav-previous"><?php echo $args['first']?></span>
		<span class="nav-next"><?php echo $args['last'] ?></span>
	</nav>
	<?php
	return ob_get_clean();
}
endif;


if ( ! function_exists( 'oh_entry_meta_header' ) ) :
/**
 * Returns HTML of meta for the current entry in the header.
 *
 * Contains author, datetime and comments link.
 *
 * @return string
 */
function oh_entry_meta_header() {
	$html = '<ul class="entry-meta">';

	$author_url = esc_url(
		get_author_posts_url( get_the_author_meta( 'ID' ) )
	);
	$author_link_title = sprintf(
		esc_attr__( 'View all posts by %s', 'oh' ), get_the_author()
	);
	$author_name = esc_html( get_the_author() );

	$author = <<<HTML
		<address class="vcard author">
			<a class="url fn" href="{$author_url}" title="{$author_link_title}" rel="author">
				{$author_name}
			</a>
		</address>
HTML;
	$author = sprintf( __( 'By %s', 'oh'), $author );

	$html .= "<li class='entry-author'>{$author}</li>";

	$datetime_iso = esc_attr( get_the_date( 'c' ) );
	$datetime = esc_html( get_the_date() );

	$html .= <<<HTML
		<li class='entry-datetime'>
			<time class='published' pubdate datetime='{$datetime_iso}'>
				{$datetime}
			</time>
		</li>
HTML;

	if ( comments_open() && ! post_password_required() ) :
		ob_start();
		comments_popup_link(
			__( 'Leave a comment', 'oh' ),
			__( '1 Comment', 'oh' ), __( '% Comments', 'oh' )
		);
		$comments_link = ob_get_clean();
		$html .= "<li class='entry-comments'>{$comments_link}</li>";
	endif;

	$html .= '</ul>';

	return $html;
}
endif;


if ( ! function_exists( 'oh_entry_meta_footer' ) ) :
/**
 * Returns HTML of meta for the current entry in the footer.
 *
 * Contains categories and tags.
 *
 * @return string
 */
function oh_entry_meta_footer() {
	$html = '<ul class="entry-meta">';

	$category_list = get_the_category_list( __( ', ', 'oh' ) );
	if ( $category_list ) {
		$categories = sprintf( __( 'Posted in %s', 'oh' ), $category_list );
		$html .= "<li class='entry-categories'>{$categories}</li>";
	}

	// translators: used between list items, there is a space after the comma
	$tags_list = get_the_tag_list( '', __( ', ', 'oh' ) );
	if ( $tags_list ) {
		$tags = sprintf( __( 'Tagged %s', 'oh' ), $tags_list );
		$html .= "<li class='entry-tags'>{$tags}</li>";
	}

	$html .= '</ul>';

	return $html;
}
endif;


if ( ! function_exists( 'oh_head_title' ) ) :
/**
 * Returns HTML of content for the title tag.
 *
 * @return string
 */
function oh_head_title() {
	ob_start();

	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'oh' ), max( $paged, $page ) );

	return ob_get_clean();
}
endif;


if ( ! function_exists( 'oh_link_pages' ) ) :
/**
 * Returns HTML of pagination for the current entry.
 *
 * @return string
 */
function oh_wp_link_pages() {
	ob_start();
	wp_link_pages( array(
		'before' => '<div class="entry-pagination">' . __( 'Pages:', 'oh' ),
		'after' => '</div>'
	) );
	return ob_get_clean();
}
endif;


if ( ! function_exists( 'oh_entry_actions' ) ) :
/**
 * Returns HTML of the edit entry link.
 *
 * @return string
 */
function oh_entry_actions() {
	ob_start();
	edit_post_link( __( 'Edit', 'oh' ) );
	$edit_post_link = ob_get_clean();
	if ( $edit_post_link ) {
		return "<div class='actions'>{$edit_post_link}</div>";
	}
	return '';
}
endif;
