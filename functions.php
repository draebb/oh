<?php
/**
 * Oh functions and definitions
 *
 * @package Oh
 * @subpackage Funtions
 */


require_once TEMPLATEPATH . '/template-helpers.php';


if ( ! isset( $content_width ) ) {
	$content_width = 714;
}


add_action( 'after_setup_theme', 'oh_setup' );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function oh_setup() {
	load_theme_textdomain( 'oh', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/{$locale}.php";
	if ( is_readable( $locale_file ) ) {
		require_once( $locale_file );
	}

	add_theme_support( 'automatic-feed-links' );

	register_nav_menu( 'main', __( 'Main Menu', 'oh' ) );

}


add_action( 'widgets_init', 'oh_register_widget_areas' );
/**
 * Registers widget areas.
 */
function oh_register_widget_areas() {
	$common_args = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	);

	register_sidebar( array_merge( $common_args, array(
		'name' => __( 'Left Sidebar', 'oh' ),
		'id' => 'sidebar-first',
	) ) );

	register_sidebar( array_merge( $common_args, array(
		'name' => __( 'Right Sidebar', 'oh' ),
		'id' => 'sidebar-second',
	) ) );
}


add_filter( 'body_class', 'oh_body_classes' );
/**
 * Adds single-author class if has only one author with published posts.
 */
function oh_body_classes( $classes ) {
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}
	return $classes;
}



add_filter( 'wp_page_menu_args', 'oh_show_home_in_wp_page_menu' );
/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function oh_show_home_in_wp_page_menu( $args ) {
	$args['show_home'] = true;
	return $args;
}


add_filter( 'img_caption_shortcode', 'oh_img_caption_shortcode', 10, 3);
/**
 * Reimplementation of the "caption" shortcode.
 *
 * Uses HTML5 tag and no 10px gap.
 */
function oh_img_caption_shortcode( $val,  $attr, $content=null ) {
	extract( shortcode_atts( array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	), $attr ) );

	$id = esc_attr( $id );
	$align = esc_attr( $align );
	$width = (int) $width;
	$content = do_shortcode( $content );

	if ( $width < 1 || empty( $caption ) ) {
		return $content;
	}

	$id_tag = '';
	if ( $id ) {
		$id_tag = "id='{$id}'";
	}

	return <<<HTML
		<figure {$id_tag} class="{$align}" style="width: {$width}px">
			{$content}
			<figcaption>{$caption}</figcaption>
		</figure>
HTML;
}


add_filter( 'template_include', 'oh_render_the_template');
/**
 * Renders the template.
 */
function oh_render_the_template( $template ) {
	require_once TEMPLATEPATH . '/inc/tpl/src/class-tpl-wp.php';
	$tpl = new Tpl_WP();
	echo $tpl->render( $template );
}
