<?php
/**
 * Title: Areas we serve
 * Slug: cozmic/areas-served
 * Categories: cozmic-section
 * Description: Heading, intro, and a wrapped list of service-area pills.
 *
 * @package CozmicBlockTheme
 *
 * Naming real towns is one of the highest-value things a local business can put
 * on a page, so the pills are plain text a client can edit or extend freely -
 * add a paragraph with the Pill style and it joins the row.
 *
 * Pill styling lives in theme.json (styles.blocks.core/paragraph.variations),
 * tinted with color-mix against the site's primary, so pills follow whatever
 * brand colour a client site is set to instead of freezing one.
 *
 * A map belongs here too, but a Google Maps embed is client-specific - add it
 * below the pills with a Custom HTML block.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">Areas we serve</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
	<p class="has-text-align-center has-large-font-size">Proudly serving the towns below, and everywhere in between.</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":"0.75rem"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
	<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50)">
		<!-- wp:paragraph {"className":"is-style-cozmic-pill"} -->
		<p class="is-style-cozmic-pill">Augusta</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"is-style-cozmic-pill"} -->
		<p class="is-style-cozmic-pill">Waterville</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"is-style-cozmic-pill"} -->
		<p class="is-style-cozmic-pill">Belgrade</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"is-style-cozmic-pill"} -->
		<p class="is-style-cozmic-pill">Winthrop</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"is-style-cozmic-pill"} -->
		<p class="is-style-cozmic-pill">Gardiner</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"is-style-cozmic-pill"} -->
		<p class="is-style-cozmic-pill">Hallowell</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
