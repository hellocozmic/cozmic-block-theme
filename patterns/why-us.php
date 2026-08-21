<?php
/**
 * Title: Why choose us - three reasons
 * Slug: cozmic/why-us
 * Categories: cozmic-section
 * Description: Centered heading over three icon-led reasons to pick this business.
 *
 * @package CozmicBlockTheme
 *
 * Locking granularity: the columns themselves are UNLOCKED, so a client can add
 * a fourth reason or drop to two. The blocks inside each column are locked, so
 * an icon cannot drift away from the heading it belongs to. That is the line
 * from D4 - protect the innards of a component, never the composition.
 *
 * Icons are emoji typed straight into the paragraph, matching the platform
 * template. No icon font, no SVG library, and a client can change one without
 * asking anybody.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">Why choose us</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
	<p class="has-text-align-center has-large-font-size">One line on what sets the business apart.</p>
	<!-- /wp:paragraph -->

	<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"},"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--60)">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:paragraph {"align":"center","lock":{"move":true,"remove":true},"fontSize":"xx-large"} -->
			<p class="has-text-align-center has-xx-large-font-size">🛠️</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"textAlign":"center","level":3,"lock":{"move":true,"remove":true},"fontSize":"large"} -->
			<h3 class="wp-block-heading has-text-align-center has-large-font-size">Done right the first time</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","lock":{"move":true,"remove":true}} -->
			<p class="has-text-align-center">A sentence or two backing up the claim above.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:paragraph {"align":"center","lock":{"move":true,"remove":true},"fontSize":"xx-large"} -->
			<p class="has-text-align-center has-xx-large-font-size">📍</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"textAlign":"center","level":3,"lock":{"move":true,"remove":true},"fontSize":"large"} -->
			<h3 class="wp-block-heading has-text-align-center has-large-font-size">Local and nearby</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","lock":{"move":true,"remove":true}} -->
			<p class="has-text-align-center">A sentence or two backing up the claim above.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:paragraph {"align":"center","lock":{"move":true,"remove":true},"fontSize":"xx-large"} -->
			<p class="has-text-align-center has-xx-large-font-size">⭐</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"textAlign":"center","level":3,"lock":{"move":true,"remove":true},"fontSize":"large"} -->
			<h3 class="wp-block-heading has-text-align-center has-large-font-size">Straight answers</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","lock":{"move":true,"remove":true}} -->
			<p class="has-text-align-center">A sentence or two backing up the claim above.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
