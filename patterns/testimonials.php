<?php
/**
 * Title: Testimonials - three cards
 * Slug: cozmic/testimonials
 * Categories: cozmic-section
 * Description: Centered heading over three quoted testimonial cards.
 *
 * @package CozmicBlockTheme
 *
 * Cards use the `is-style-cozmic-card` Group variation (registered in
 * functions.php, styled in theme.json) rather than inline styles, so a client
 * restyling cards in Global Styles restyles every card on the site at once.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">What our customers say</h2>
	<!-- /wp:heading -->

	<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"},"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--60)">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-cozmic-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group is-style-cozmic-card">
				<!-- wp:quote {"lock":{"move":true,"remove":true}} -->
				<blockquote class="wp-block-quote"><!-- wp:paragraph -->
				<p>They showed up when they said they would and the price was the price. Hard to find these days.</p>
				<!-- /wp:paragraph --><cite>Sarah M. · Augusta</cite></blockquote>
				<!-- /wp:quote -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-cozmic-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group is-style-cozmic-card">
				<!-- wp:quote {"lock":{"move":true,"remove":true}} -->
				<blockquote class="wp-block-quote"><!-- wp:paragraph -->
				<p>Explained what needed doing and what could wait. I never felt talked into anything.</p>
				<!-- /wp:paragraph --><cite>Dave R. · Waterville</cite></blockquote>
				<!-- /wp:quote -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-cozmic-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group is-style-cozmic-card">
				<!-- wp:quote {"lock":{"move":true,"remove":true}} -->
				<blockquote class="wp-block-quote"><!-- wp:paragraph -->
				<p>Quick to respond and cleaned up after themselves. We have already booked them again.</p>
				<!-- /wp:paragraph --><cite>Megan T. · Belgrade</cite></blockquote>
				<!-- /wp:quote -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
