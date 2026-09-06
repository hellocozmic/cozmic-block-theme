<?php
/**
 * Title: Page header - archive banner
 * Slug: cozmic/header-banner-archive
 * Categories: cozmic-header
 * Description: The same short banner as inner pages, titled from the archive rather than a post.
 * Inserter: no
 *
 * @package CozmicBlockTheme
 *
 * Identical to cozmic/header-banner except for the title block. An archive has
 * no post to draw a title from, so post-title renders empty there and the page
 * loses its H1 - which the SEO audit flags, correctly.
 *
 * `showPrefix: false` drops core's "Archives:" prefix, so the Services archive
 * is headed "Services" rather than "Archives: Services".
 */

?>
<!-- wp:cover {"dimRatio":60,"overlayColor":"contrast","minHeight":320,"minHeightUnit":"px","isDark":true,"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull is-dark" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);min-height:320px">
	<span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-60 has-background-dim"></span>
	<div class="wp-block-cover__inner-container">
		<!-- wp:query-title {"type":"archive","textAlign":"center","level":1,"showPrefix":false,"textColor":"base","fontSize":"xx-large"} /-->
	</div>
</div>
<!-- /wp:cover -->
