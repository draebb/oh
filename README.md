Readme
======

A base theme based on Twenty Eleven.


Features
--------

- Template inheritance
- No theme options


Template Inheritance
--------------------

Template inheritance help reduces duplicate code. For example, Twenty Eleven
has this duplicate code in many templates:

	<?php get_header(); ?>

			<div id="primary">
				<div id="content" role="main">

				<?php if ( have_posts() ) : ?>

					...

					<?php twentyeleven_content_nav( 'nav-above' ); ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', get_post_format() ); ?>

					<?php endwhile; ?>

					<?php twentyeleven_content_nav( 'nav-below' ); ?>

				<?php else : ?>

					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->

				<?php endif; ?>

				</div><!-- #content -->
			</div><!-- #primary -->

	<?php get_sidebar(); ?>
	<?php get_footer(); ?>

Oh, by use template inheritance a similar code is in `index.php` only once and
a `page_header` **block** is defined, then other templates can just write like
this:

	<?php $tpl->extend( 'index.php' ); ?>

	<?php $tpl->blocks->start( 'page_header' ); ?>

		The different code

	<?php $tpl->blocks->stop(); ?>

Read more about [template inheritance][1] in the wiki.


Compass/Sass
------------

Oh uses [Compass][2] and [Sass][3] (SCSS syntax) for CSS styling. The generated
CSS file is tried to be as clean as possible for non-sass users. But Sass
pushes end-of-line comments to the next new line which affects
[normalize.css][4], you can read the original file at `sass/_normalize.scss`.

All related files includes `config.rb` are located in the `sass` directory.


[1]: https://github.com/draebb/oh/wiki/Template-Inheritance
[2]: http://compass-style.org/
[3]: http://sass-lang.com/
[4]: https://github.com/necolas/normalize.css
