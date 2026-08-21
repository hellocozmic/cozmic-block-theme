<?php
/**
 * Title: About - split with image
 * Slug: cozmic/about
 * Categories: cozmic-section
 * Description: Two-column introduction to the business, text beside an image.
 *
 * @package CozmicBlockTheme
 *
 * The image ships a neutral placeholder from the theme rather than an empty
 * upload box, so the pattern preview reads as a real layout and the client
 * clicks Replace instead of hunting for the right aspect ratio. Rounded corners
 * live in theme.json (styles.blocks.core/image), not in the block attributes -
 * hand-written attributes are the main source of block-validation mismatches,
 * and putting the radius in theme.json also makes it reachable from Global
 * Styles. Aspect ratio is deliberately unset so a client's own photo is never
 * force-cropped.
 *
 * Locking: the columns are unlocked so a client can flip the image to the other
 * side or drop it entirely. The blocks *inside* each column are locked against
 * move/remove so the heading cannot be dragged away from its paragraph.
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:heading {"lock":{"move":true,"remove":true},"fontSize":"x-large"} -->
			<h2 class="wp-block-heading has-x-large-font-size">About us</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"lock":{"move":true,"remove":true},"fontSize":"large"} -->
			<p class="has-large-font-size">Two or three sentences on who you are, how long you have been doing this, and why someone nearby should call you rather than the next name on the list.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/placeholder.svg" alt=""/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
