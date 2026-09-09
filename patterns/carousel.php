<?php
/**
 * Title: Carousel - three panels
 * Slug: cozmic/carousel
 * Categories: cozmic-section
 * Description: Three panels that slide sideways, each with a headline, a line of copy, and an image.
 *
 * @package CozmicBlockTheme
 *
 * NOT A CUSTOM BLOCK (docs D4)
 * ----------------------------
 * This is a Group holding a flex Group holding three Groups. The sliding comes
 * from `cz-carousel*` classes that style.css turns into a CSS scroll-snap
 * strip, and assets/js/carousel.js adds dots and auto-advance on top.
 *
 * The consequence worth knowing: with CSS or JS unavailable this degrades to
 * three stacked sections of ordinary readable content, and there is no block
 * to deactivate that could ever orphan it.
 *
 * The track is a plain *stacked* group here and becomes a flex strip only in
 * style.css. Keep it that way. Declaring the flex layout in this markup means
 * that any moment the stylesheet is older than the content - which is every
 * moment between a REST content push and a manual theme upload - renders the
 * slides crushed into a single row, a word per line. Stacked markup degrades to
 * three readable panels instead.
 */

?>
<!-- wp:group {"className":"cz-carousel","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group cz-carousel alignfull has-surface-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"className":"cz-carousel__track"} -->
	<div class="wp-block-group cz-carousel__track">
		<!-- wp:group {"className":"cz-carousel__slide","layout":{"type":"constrained"}} -->
		<div class="wp-block-group cz-carousel__slide">
			<!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
			<div class="wp-block-columns alignwide are-vertically-aligned-center">
				<!-- wp:column {"verticalAlignment":"center"} -->
				<div class="wp-block-column is-vertically-aligned-center">
					<!-- wp:heading {"lock":{"move":true,"remove":true},"fontSize":"x-large"} -->
					<h2 class="wp-block-heading has-x-large-font-size">The first thing worth saying</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"lock":{"move":true,"remove":true},"fontSize":"large"} -->
					<p class="has-large-font-size">A sentence or two. Keep each panel to one idea, because only one is on screen at a time.</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"verticalAlignment":"center"} -->
				<div class="wp-block-column is-vertically-aligned-center">
					<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
					<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/placeholder.svg" alt=""/></figure>
					<!-- /wp:image -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"cz-carousel__slide","layout":{"type":"constrained"}} -->
		<div class="wp-block-group cz-carousel__slide">
			<!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
			<div class="wp-block-columns alignwide are-vertically-aligned-center">
				<!-- wp:column {"verticalAlignment":"center"} -->
				<div class="wp-block-column is-vertically-aligned-center">
					<!-- wp:heading {"lock":{"move":true,"remove":true},"fontSize":"x-large"} -->
					<h2 class="wp-block-heading has-x-large-font-size">The second thing</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"lock":{"move":true,"remove":true},"fontSize":"large"} -->
					<p class="has-large-font-size">Another single idea, roughly the same length as the first so the panels do not jump in height.</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"verticalAlignment":"center"} -->
				<div class="wp-block-column is-vertically-aligned-center">
					<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
					<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/placeholder.svg" alt=""/></figure>
					<!-- /wp:image -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"cz-carousel__slide","layout":{"type":"constrained"}} -->
		<div class="wp-block-group cz-carousel__slide">
			<!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
			<div class="wp-block-columns alignwide are-vertically-aligned-center">
				<!-- wp:column {"verticalAlignment":"center"} -->
				<div class="wp-block-column is-vertically-aligned-center">
					<!-- wp:heading {"lock":{"move":true,"remove":true},"fontSize":"x-large"} -->
					<h2 class="wp-block-heading has-x-large-font-size">The third thing</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"lock":{"move":true,"remove":true},"fontSize":"large"} -->
					<p class="has-large-font-size">Three is about the limit. Past that, the last panels are seen by almost nobody.</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"verticalAlignment":"center"} -->
				<div class="wp-block-column is-vertically-aligned-center">
					<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
					<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/placeholder.svg" alt=""/></figure>
					<!-- /wp:image -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
