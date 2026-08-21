<?php
/**
 * Title: Latest posts - three across
 * Slug: cozmic/blog
 * Categories: cozmic-content, cozmic-section
 * Description: The three most recent blog posts as cards.
 *
 * @package CozmicBlockTheme
 *
 * Uses core's Query Loop against the built-in `post` type, so this pattern
 * needs nothing from Cozmic Core - unlike services, events, and portfolio,
 * which query custom post types that do not exist yet.
 *
 * `inherit: false` matters: without it the loop adopts the main query and shows
 * whatever the current page is about rather than the latest posts.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">From the blog</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":1,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-query alignwide" style="margin-top:var(--wp--preset--spacing--60)">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->

			<!-- wp:post-title {"isLink":true,"level":3,"fontSize":"large"} /-->

			<!-- wp:post-date {"fontSize":"small"} /-->

			<!-- wp:post-excerpt {"excerptLength":22} /-->
		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">No posts yet.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
