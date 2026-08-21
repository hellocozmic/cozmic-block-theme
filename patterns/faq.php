<?php
/**
 * Title: FAQ - accordion
 * Slug: cozmic/faq
 * Categories: cozmic-section
 * Description: Frequently asked questions as an expand-and-collapse list.
 *
 * @package CozmicBlockTheme
 *
 * Built on core/details, which is a native <details>/<summary> element - it
 * expands with zero JavaScript, exactly like the platform template's FAQ block.
 *
 * NOTE: the platform emits FAQPage JSON-LD from this block's question/answer
 * pairs. Core will not do that on its own, so the equivalent belongs in Cozmic
 * Core as a hook that scans post content for details blocks. Until then this
 * pattern is visually right but structurally invisible to search engines.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">Common questions</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--60)">
		<!-- wp:details {"summary":"What areas do you serve?"} -->
		<details class="wp-block-details"><summary>What areas do you serve?</summary><!-- wp:paragraph -->
		<p>List the towns and the rough radius. Naming real places helps people nearby find you.</p>
		<!-- /wp:paragraph --></details>
		<!-- /wp:details -->

		<!-- wp:details {"summary":"How quickly can you get out here?"} -->
		<details class="wp-block-details"><summary>How quickly can you get out here?</summary><!-- wp:paragraph -->
		<p>Set an honest expectation. Under-promising here is worth more than the booking it might cost.</p>
		<!-- /wp:paragraph --></details>
		<!-- /wp:details -->

		<!-- wp:details {"summary":"Do you give free estimates?"} -->
		<details class="wp-block-details"><summary>Do you give free estimates?</summary><!-- wp:paragraph -->
		<p>Answer plainly, including anything that is not covered.</p>
		<!-- /wp:paragraph --></details>
		<!-- /wp:details -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
