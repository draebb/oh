<?php
/**
 * The base template.
 *
 * @package Oh
 * @subpackage Template
 */


// Oh did not use get_header() but some plugins hook the action, so do here.
do_action( 'get_header' );
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php echo oh_head_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

<div class="inner">
	<a class="visually-hidden focusable" href="#main"><?php _e( 'Skip to main content', 'oh' ); ?></a>
</div>

<header id="header" role="banner">
<div class="inner">

	<?php $site_title_tag = is_home() || is_front_page() ? 'h1': 'div'; ?>
	<<?php echo $site_title_tag; ?> id="site-title">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
	</<?php echo $site_title_tag; ?>>
	<?php if ( get_bloginfo( 'description' ) ): ?>
		<div id="site-description"><?php bloginfo( 'description' ); ?></div>
	<?php endif; ?>

	<nav role="navigation">
		<h2 class="visually-hidden"><?php _e( 'Main menu', 'oh' ); ?></h2>
		<div id="main-menu"><?php wp_nav_menu( array( 'theme_location' => 'main' ) ); ?></div>
	</nav>

</div>
</header>

<div id="content">
<div class="inner">

	<?php // block content ?>
	<?php echo $tpl->blocks->get( 'content' ); ?>
	<?php // end block ?>

</div>
</div>

<footer id="footer" role="contentinfo">
<div class="inner">

	Powered by <a href="http://wordpress.org/">WordPress</a>

</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
