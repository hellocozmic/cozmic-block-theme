<?php
/**
 * Title: Page header - banner
 * Slug: cozmic/header-banner
 * Categories: cozmic-header
 * Description: Short title banner for inner pages. Equivalent to the platform's `banner` header variant.
 * Inserter: no
 *
 * @package Cozmic
 */

?>
<!-- wp:cover {"dimRatio":60,"overlayColor":"contrast","minHeight":320,"minHeightUnit":"px","isDark":true,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull is-dark" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);min-height:320px">
	<span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-60 has-background-dim"></span>
	<div class="wp-block-cover__inner-container">
		<!-- wp:post-title {"textAlign":"center","level":1,"textColor":"base","fontSize":"xx-large"} /-->
	</div>
</div>
<!-- /wp:cover -->
