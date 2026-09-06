<?php
/**
 * Title: Services - three across
 * Slug: cozmic/services
 * Categories: cozmic-content, cozmic-section
 * Description: Three services as cards, with a link to the full list.
 *
 * @package CozmicBlockTheme
 *
 * Queries the `cozmic_service` post type from Cozmic Core. If that plugin is
 * inactive or the content type is switched off, the type does not exist and
 * this pattern is unregistered in functions.php rather than offered and left to
 * render nothing.
 *
 * `inherit: false` matters: without it the loop adopts the main query and shows
 * whatever the current page is about rather than the services.
 *
 * The "See all" link can hardcode /services/ because Core fixes the archive
 * slug. The blog pattern deliberately has no equivalent - the posts page is a
 * WordPress setting and could be anywhere.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">What we do</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":1,"offset":0,"postType":"cozmic_service","order":"asc","orderBy":"menu_order","inherit":false},"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"default"}} -->
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
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/services/">See all services</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
