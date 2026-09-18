<?php
/**
 * Title: In the news - three across
 * Slug: cozmic/in-the-news
 * Categories: cozmic-content, cozmic-section
 * Description: Recent press coverage as cards, each linking out to the article.
 *
 * @package CozmicBlockTheme
 *
 * Queries the `cozmic_press` post type from Cozmic Core, and is unregistered in
 * functions.php when that type does not exist.
 *
 * Every link on a card leads to the publication's own article, not to a page
 * here. The button is bound to `cozmic_press_link`, which is the article when
 * one is set and the entry's own page when it is not, so a card can never carry
 * a dead button. The image and the title use the ordinary permalink, which Core
 * redirects to the same article.
 *
 * The "Rockford Squire · August 14, 2026" line is one bound paragraph rather
 * than two blocks, for the reason the events pattern gives: a template has no
 * conditionals, so a mention with no publication set would otherwise render a
 * stray separator.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">In the news</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":1,"offset":0,"postType":"cozmic_press","order":"desc","orderBy":"date","inherit":false},"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-query alignwide" style="margin-top:var(--wp--preset--spacing--60)">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3"} /-->

			<!-- wp:post-title {"isLink":true,"level":3,"fontSize":"large"} /-->

			<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"cozmic/field","args":{"key":"cozmic_press_details"}}}},"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}},"textColor":"primary-ink","fontSize":"small"} -->
			<p class="has-primary-ink-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--20)">Where and when it ran.</p>
			<!-- /wp:paragraph -->

			<!-- wp:post-excerpt {"excerptLength":22} /-->

			<!-- wp:read-more {"content":"Read more"} /-->
		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">No coverage listed yet.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->

	<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)">
		<!-- wp:button {"className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/in-the-news/">See every mention</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
