<?php
/**
 * Title: Portfolio - three across
 * Slug: cozmic/portfolio
 * Categories: cozmic-content, cozmic-section
 * Description: Three recent projects as cards, with a link to the full portfolio.
 *
 * @package CozmicBlockTheme
 *
 * Queries the `cozmic_project` post type from Cozmic Core, and is unregistered
 * in functions.php when that type does not exist.
 *
 * Ordered by `menu_order` so the client decides which work leads. That is the
 * one ordering a portfolio needs and the block can express it, so unlike events
 * nothing overrides it - a client who prefers newest-first can change it here.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">Recent work</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":1,"offset":0,"postType":"cozmic_project","order":"asc","orderBy":"menu_order","inherit":false},"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-query alignwide" style="margin-top:var(--wp--preset--spacing--60)">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3"} /-->

			<!-- wp:post-title {"isLink":true,"level":3,"fontSize":"large"} /-->

			<!-- wp:post-excerpt {"excerptLength":22} /-->
		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">Nothing here yet.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->

	<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)">
		<!-- wp:button {"className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/portfolio/">See all projects</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
