<?php
/**
 * Title: Spotlight - centered announcement
 * Slug: cozmic/spotlight
 * Categories: cozmic-section
 * Description: Centered eyebrow, headline, supporting line, and button. For drawing attention to one thing.
 *
 * @package CozmicBlockTheme
 *
 * The eyebrow uses primary-ink rather than primary: brand colours chosen as a
 * fill are frequently too light to read as small text on white, and -ink is the
 * darkened variant the dashboard derives for exactly this case.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:paragraph {"align":"center","lock":{"move":true,"remove":true},"textColor":"primary-ink","fontSize":"small","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"}}} -->
	<p class="has-text-align-center has-primary-ink-color has-text-color has-small-font-size" style="font-weight:600;letter-spacing:0.08em;text-transform:uppercase">Now booking</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"textAlign":"center","lock":{"move":true,"remove":true},"fontSize":"xx-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-xx-large-font-size">Something worth saying loudly</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","lock":{"move":true,"remove":true},"fontSize":"large"} -->
	<p class="has-text-align-center has-large-font-size">A line or two of detail. Keep it to what someone needs in order to act.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"lock":{"move":true,"remove":true},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact">Get in touch</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
