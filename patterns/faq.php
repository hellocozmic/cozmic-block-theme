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
 * FAQPage JSON-LD comes from Cozmic Core, which scans the page for Details
 * blocks and builds the structured data from their summaries and answers (see
 * inc/seo.php there). Nothing in this pattern needs to opt in, and an FAQ a
 * client composes by hand out of Details blocks is picked up the same way. Two
 * pairs is the floor, so a single Details block stays an expandable note rather
 * than being announced as an FAQ.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
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
