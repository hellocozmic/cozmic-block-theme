<?php
/**
 * Title: Call to action - banner
 * Slug: cozmic/cta-banner
 * Categories: cozmic-cta, cozmic-section
 * Description: Full-width call-to-action band with a heading, supporting line, and button.
 *
 * @package Cozmic
 *
 * LOCKING CONVENTION (docs D4)
 * ---------------------------
 * The outer Group carries NO lock: the client must be able to move this whole
 * section, duplicate it, or delete it. That freedom is the point of the tier.
 *
 * The inner blocks carry `"lock":{"move":true,"remove":true}`: fully editable
 * and stylable, but they cannot be dragged out of the band or deleted, which is
 * how this layout gets broken in practice.
 *
 * Do NOT reach for templateLock "contentOnly" here - it also strips colour,
 * spacing, and typography controls, which is a bigger loss than the structural
 * protection is worth for a section this simple.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"primary","textColor":"on-primary","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-on-primary-color has-primary-background-color has-text-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","level":2,"lock":{"move":true,"remove":true},"fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">Ready to get started?</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","lock":{"move":true,"remove":true}} -->
	<p class="has-text-align-center">Tell us what you need and we will take it from there.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"lock":{"move":true,"remove":true},"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"backgroundColor":"base","textColor":"contrast"} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background wp-element-button" href="/contact">Contact us</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
