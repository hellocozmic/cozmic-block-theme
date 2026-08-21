<?php
/**
 * Title: CTA cards - three offers
 * Slug: cozmic/cta-cards
 * Categories: cozmic-cta, cozmic-section
 * Description: Three side-by-side offer or pricing cards, with the middle one highlighted.
 *
 * @package CozmicBlockTheme
 *
 * This is the densest pattern in the library - six editable fields per card -
 * and the one most likely to earn a real custom block later (see D4). Until it
 * does, the columns stay unlocked so a client can drop to two offers or add a
 * fourth, while everything inside a card is locked so the pieces cannot drift
 * apart.
 *
 * The highlighted card uses the cozmic-card-featured style variation rather
 * than inline styling, so what "featured" looks like stays changeable
 * fleet-wide from theme.json.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">How we can help</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
	<p class="has-text-align-center has-large-font-size">Pick the option that fits, or call and we will work it out together.</p>
	<!-- /wp:paragraph -->

	<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"},"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--60)">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-cozmic-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group is-style-cozmic-card">
				<!-- wp:heading {"textAlign":"center","level":3,"lock":{"move":true,"remove":true},"fontSize":"large"} -->
				<h3 class="wp-block-heading has-text-align-center has-large-font-size">The basics</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"align":"center","lock":{"move":true,"remove":true}} -->
				<p class="has-text-align-center">One line on who this suits.</p>
				<!-- /wp:paragraph -->

				<!-- wp:list {"lock":{"move":true,"remove":true}} -->
				<ul class="wp-block-list"><!-- wp:list-item -->
				<li>What is included</li>
				<!-- /wp:list-item --><!-- wp:list-item -->
				<li>Another thing included</li>
				<!-- /wp:list-item --><!-- wp:list-item -->
				<li>One more</li>
				<!-- /wp:list-item --></ul>
				<!-- /wp:list -->

				<!-- wp:buttons {"lock":{"move":true,"remove":true},"layout":{"type":"flex","justifyContent":"center"}} -->
				<div class="wp-block-buttons">
					<!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact">Ask about this</a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-cozmic-card-featured","layout":{"type":"constrained"}} -->
			<div class="wp-block-group is-style-cozmic-card-featured">
				<!-- wp:heading {"textAlign":"center","level":3,"lock":{"move":true,"remove":true},"fontSize":"large"} -->
				<h3 class="wp-block-heading has-text-align-center has-large-font-size">Most popular</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"align":"center","lock":{"move":true,"remove":true}} -->
				<p class="has-text-align-center">One line on who this suits.</p>
				<!-- /wp:paragraph -->

				<!-- wp:list {"lock":{"move":true,"remove":true}} -->
				<ul class="wp-block-list"><!-- wp:list-item -->
				<li>Everything in the basics</li>
				<!-- /wp:list-item --><!-- wp:list-item -->
				<li>Plus the thing people ask for</li>
				<!-- /wp:list-item --><!-- wp:list-item -->
				<li>And one more</li>
				<!-- /wp:list-item --></ul>
				<!-- /wp:list -->

				<!-- wp:buttons {"lock":{"move":true,"remove":true},"layout":{"type":"flex","justifyContent":"center"}} -->
				<div class="wp-block-buttons">
					<!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact">Ask about this</a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-cozmic-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group is-style-cozmic-card">
				<!-- wp:heading {"textAlign":"center","level":3,"lock":{"move":true,"remove":true},"fontSize":"large"} -->
				<h3 class="wp-block-heading has-text-align-center has-large-font-size">The works</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"align":"center","lock":{"move":true,"remove":true}} -->
				<p class="has-text-align-center">One line on who this suits.</p>
				<!-- /wp:paragraph -->

				<!-- wp:list {"lock":{"move":true,"remove":true}} -->
				<ul class="wp-block-list"><!-- wp:list-item -->
				<li>Everything above</li>
				<!-- /wp:list-item --><!-- wp:list-item -->
				<li>The bigger job</li>
				<!-- /wp:list-item --><!-- wp:list-item -->
				<li>Priority scheduling</li>
				<!-- /wp:list-item --></ul>
				<!-- /wp:list -->

				<!-- wp:buttons {"lock":{"move":true,"remove":true},"layout":{"type":"flex","justifyContent":"center"}} -->
				<div class="wp-block-buttons">
					<!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact">Ask about this</a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
