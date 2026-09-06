<?php
/**
 * Title: Events - three across
 * Slug: cozmic/events
 * Categories: cozmic-content, cozmic-section
 * Description: The next three events as cards, with a link to the full calendar.
 *
 * @package CozmicBlockTheme
 *
 * Queries the `cozmic_event` post type from Cozmic Core, and is unregistered in
 * functions.php when that type does not exist.
 *
 * The order here is not what the block attributes below say. Query Loop
 * attributes cannot express "sort by a meta value", so Core reorders event
 * queries through the `query_loop_block_query_vars` filter to put the soonest
 * first. Without that, this section would list events in the order somebody
 * typed them in.
 *
 * The date line is one bound paragraph rather than separate date and location
 * blocks, because a template has no conditionals and an event missing either
 * one would render a stray label. Core composes the whole phrase; the fallback
 * written below is what shows when nothing is set.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">What is coming up</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":1,"offset":0,"postType":"cozmic_event","order":"asc","orderBy":"date","inherit":false},"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-query alignwide" style="margin-top:var(--wp--preset--spacing--60)">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3"} /-->

			<!-- wp:post-title {"isLink":true,"level":3,"fontSize":"large"} /-->

			<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"cozmic/field","args":{"key":"cozmic_event_details"}}}},"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}},"textColor":"primary-ink","fontSize":"small"} -->
			<p class="has-primary-ink-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--20)">Date and location to be announced.</p>
			<!-- /wp:paragraph -->

			<!-- wp:post-excerpt {"excerptLength":22} /-->
		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">Nothing on the calendar right now.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->

	<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)">
		<!-- wp:button {"className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/events/">See all events</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
