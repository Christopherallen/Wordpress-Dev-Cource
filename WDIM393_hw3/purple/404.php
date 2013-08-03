<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Uh Oh, I don&rsquo;t think this is what you were looking for !', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help. ', 'twentytwelve' ); ?></p>
					<p><a href=" " class="btn"><?php _e( 'Take me Home', 'twentytwelve' ); ?></a></p>

					<p><?php _e( '<a href="http://forgifs.com" target="_blank"><img src="http://forgifs.com/gallery/d/153525-4/Black-kid-dancing.gif?" alt="forgifs.com" /></a> ', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>