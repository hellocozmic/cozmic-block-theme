<?php
/**
 * Title: Page header - banner with featured image
 * Slug: cozmic/header-banner-page
 * Categories: cozmic-header
 * Description: The inner-page banner, with the page's featured image behind the title.
 * Inserter: no
 *
 * @package CozmicBlockTheme
 *
 * Identical to cozmic/header-banner except that the cover draws the featured
 * image. That's what the platform's `banner` variant does with a page's header
 * image, and what a client expects after setting a featured image. With no
 * featured image it renders exactly like the plain banner.
 *
 * Pages only. The single templates keep the plain banner because they already
 * place the featured image in the body, where a project photo or an event
 * flyer is shown whole instead of cropped and dimmed behind the title.
 *
 * `sizeSlug: full` because the banner is full-bleed. Core's default is
 * `post-thumbnail`, which only works today because nothing registers that
 * size; a child theme that did would shrink every banner.
 *
 * The `cz-page-banner` class is the hook `cozmic_page_banner()` in functions.php
 * matches on to apply the page's own banner fields - height, image position,
 * background video - which Cozmic Core stores as page meta. That happens at
 * render, so the editor's template preview always shows the standard banner
 * however the page is set.
 */

?>
<!-- wp:cover {"useFeaturedImage":true,"sizeSlug":"full","dimRatio":60,"overlayColor":"contrast","minHeight":320,"minHeightUnit":"px","isDark":true,"align":"full","className":"cz-page-banner","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull cz-page-banner" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);min-height:320px">
	<span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-60 has-background-dim"></span>
	<div class="wp-block-cover__inner-container">
		<!-- wp:post-title {"textAlign":"center","level":1,"textColor":"base","fontSize":"xx-large"} /-->
	</div>
</div>
<!-- /wp:cover -->
