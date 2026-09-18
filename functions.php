<?php
/**
 * Cozmic Block Theme — the parent theme.
 *
 * Presentation only. Anything that defines *what exists* — post types, meta,
 * roles, options — belongs in the Cozmic Core plugin, not here. A client who
 * switches themes must keep their content.
 *
 * Naming: the theme slug and text domain are `cozmic-block-theme`; the PHP
 * prefix stays the shorter `cozmic_`. Patterns use the `cozmic/` namespace
 * deliberately — it is a Cozmic-wide library namespace, not this theme's, so
 * Cozmic Core can register into it later without a second vocabulary.
 *
 * @package CozmicBlockTheme
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'COZMIC_THEME_VERSION', '0.5.0' );

/**
 * Theme setup.
 *
 * Block themes get most supports implicitly. Declared here are the ones that
 * still need opting into.
 */
function cozmic_setup(): void {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', array( 'search-form', 'style', 'script' ) );

	add_editor_style( 'style.css' );

	load_theme_textdomain( 'cozmic-block-theme', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'cozmic_setup' );

/**
 * Front-end styles.
 *
 * Child themes are theme.json-only by convention, so only the parent's
 * stylesheet is enqueued. A child that genuinely needs CSS can enqueue its own.
 */
function cozmic_enqueue_styles(): void {
	wp_enqueue_style(
		'cozmic-block-theme',
		get_template_directory_uri() . '/style.css',
		array(),
		COZMIC_THEME_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'cozmic_enqueue_styles' );

/**
 * Whether the thing being viewed contains a marker string.
 *
 * Used to decide whether a behaviour's script is worth sending. Reads the
 * queried post's raw content rather than the rendered output, because
 * enqueueing has to be decided before anything renders.
 *
 * Only the singular case is answered honestly; an archive renders many posts
 * and none of the current behaviours appear in one, so it returns false rather
 * than querying every post in the loop to find out.
 *
 * @param string $marker Class name or other substring to look for.
 */
function cozmic_content_has( string $marker ): bool {
	if ( ! is_singular() ) {
		return false;
	}

	$post = get_post();

	return $post instanceof WP_Post && str_contains( $post->post_content, $marker );
}

/**
 * Front-end scripts.
 *
 * Both are deferred, and both have to survive the same test: the page must
 * still be correct with the script blocked. A client site should never depend
 * on JavaScript to render what it says. The sticky header only loses its
 * shadow; the carousel stays a scroll-snap strip that swipes and tabs.
 */
function cozmic_enqueue_scripts(): void {
	wp_enqueue_script(
		'cozmic-sticky-header',
		get_template_directory_uri() . '/assets/js/sticky-header.js',
		array(),
		COZMIC_THEME_VERSION,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	// Only where a carousel exists. Nothing on the page needs it otherwise,
	// and most pages have none.
	if ( cozmic_content_has( 'cz-carousel' ) ) {
		wp_enqueue_script(
			'cozmic-carousel',
			get_template_directory_uri() . '/assets/js/carousel.js',
			array(),
			COZMIC_THEME_VERSION,
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'cozmic_enqueue_scripts' );

/**
 * Pattern categories.
 *
 * Patterns live in /patterns and are auto-registered by WordPress from their
 * file headers. Only the categories need declaring.
 */
function cozmic_register_pattern_categories(): void {
	$categories = array(
		'cozmic-header'   => __( 'Cozmic: Page headers', 'cozmic-block-theme' ),
		'cozmic-section'  => __( 'Cozmic: Sections', 'cozmic-block-theme' ),
		'cozmic-content'  => __( 'Cozmic: Content lists', 'cozmic-block-theme' ),
		'cozmic-cta'      => __( 'Cozmic: Calls to action', 'cozmic-block-theme' ),
	);

	foreach ( $categories as $slug => $label ) {
		register_block_pattern_category( $slug, array( 'label' => $label ) );
	}
}
add_action( 'init', 'cozmic_register_pattern_categories' );

/**
 * Hide the content-list patterns when their post type is not there.
 *
 * The services, events, and portfolio patterns query post types that Cozmic
 * Core registers, and Core only registers each one when that content type is
 * switched on. Offering a pattern that can only ever render "Nothing here yet"
 * is worse than not offering it: the client inserts it, sees an empty section,
 * and reasonably concludes the theme is broken.
 *
 * Priority 20 puts this after WordPress auto-registers the theme's patterns
 * from /patterns and after Core registers its post types on the same hook.
 *
 * Checking `post_type_exists` rather than asking Core directly means this also
 * does the right thing when Core is missing altogether, and keeps the theme
 * free of a hard dependency on a function from another artifact.
 */
function cozmic_unregister_absent_patterns(): void {
	$patterns = array(
		'cozmic/services'    => 'cozmic_service',
		'cozmic/events'      => 'cozmic_event',
		'cozmic/portfolio'   => 'cozmic_project',
		'cozmic/in-the-news' => 'cozmic_press',
	);

	$registry = WP_Block_Patterns_Registry::get_instance();

	foreach ( $patterns as $pattern => $post_type ) {
		if ( ! post_type_exists( $post_type ) && $registry->is_registered( $pattern ) ) {
			unregister_block_pattern( $pattern );
		}
	}
}
add_action( 'init', 'cozmic_unregister_absent_patterns', 20 );

/**
 * Block style variations.
 *
 * Preferred over custom blocks (see docs D4): a style variation is core markup
 * with a class, so it degrades gracefully and never orphans client content.
 */
function cozmic_register_block_styles(): void {
	register_block_style(
		'core/group',
		array(
			'name'  => 'cozmic-card',
			'label' => __( 'Card', 'cozmic-block-theme' ),
		)
	);

	register_block_style(
		'core/group',
		array(
			'name'  => 'cozmic-card-featured',
			'label' => __( 'Card (featured)', 'cozmic-block-theme' ),
		)
	);

	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'cozmic-pill',
			'label' => __( 'Pill', 'cozmic-block-theme' ),
		)
	);

	// Fills the first screen below the header. See style.css for the sizing.
	register_block_style(
		'core/cover',
		array(
			'name'  => 'cozmic-fill-screen',
			'label' => __( 'Fill screen', 'cozmic-block-theme' ),
		)
	);
}
add_action( 'init', 'cozmic_register_block_styles' );

/**
 * Anything hidden on mobile must not cost mobile bandwidth.
 *
 * `cz-hide-on-mobile` hides with CSS, and a hidden <img> is still downloaded
 * unless it is lazy: the browser starts the request when it parses the tag,
 * long before layout knows the image will never be shown. WordPress eager-loads
 * the first few images on a page on purpose, since they are usually above the
 * fold, so a hidden image near the top - a hero carousel's, say - cost phones
 * the whole file for nothing.
 *
 * A lazy image inside a display:none box is never fetched. On desktop, where
 * the image is visible, a lazy image already in the viewport still loads at
 * once; all it gives up is being the page's LCP candidate, which a decorative
 * image should never be.
 *
 * Runs at render_block, before WordPress's own loading optimisation on the
 * content, which keeps an explicit loading attribute rather than overriding it.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Parsed block.
 */
function cozmic_lazy_hidden_on_mobile( string $block_content, array $block ): string {
	$class = $block['attrs']['className'] ?? '';

	if ( ! is_string( $class ) || ! in_array( 'cz-hide-on-mobile', preg_split( '/\s+/', $class ), true ) ) {
		return $block_content;
	}

	$html = new WP_HTML_Tag_Processor( $block_content );

	while ( $html->next_tag( 'img' ) ) {
		$html->set_attribute( 'loading', 'lazy' );
	}

	return $html->get_updated_html();
}
add_filter( 'render_block', 'cozmic_lazy_hidden_on_mobile', 10, 2 );

/**
 * Whether a parsed block carries a given class.
 *
 * Whole-class matching, not a substring test: `cz-banner` must not answer for
 * `cz-archive-banner`, which is a different hook on a different template.
 *
 * @param array  $block Parsed block.
 * @param string $class Class to look for.
 */
function cozmic_block_has_class( array $block, string $class ): bool {
	$attr = $block['attrs']['className'] ?? '';

	return is_string( $attr ) && in_array( $class, preg_split( '/\s+/', trim( $attr ) ) ?: array(), true );
}

/**
 * Apply a page or post's own banner settings to its banner.
 *
 * Cozmic Core stores three fields per page - height, image position, and an
 * optional background video - because a block template has no conditionals and
 * only administrators may swap a page's template, so a variant per template
 * would be unreachable for the Editors who write pages. The data lives in Core;
 * what it looks like is this theme's business, which is why the rendering is
 * here and not there.
 *
 * It rewrites rendered HTML rather than block attributes on purpose. A cover's
 * height lives in its *saved* inline style, and its video background in saved
 * markup - only the featured image is server-rendered - so editing attributes
 * earlier in the pipeline would change nothing a visitor can see.
 *
 * Every branch is skipped when the fields are empty, so a site whose pages are
 * all standard pays one string comparison per cover and renders byte for byte
 * what it did before.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Parsed block.
 */
function cozmic_banner( string $block_content, array $block ): string {
	if ( 'core/cover' !== ( $block['blockName'] ?? '' ) ) {
		return $block_content;
	}

	if ( ! cozmic_block_has_class( $block, 'cz-banner' ) ) {
		return $block_content;
	}

	// The fields are Core's. Without it the theme keeps its standard banner.
	if ( ! is_singular() || ! function_exists( 'cozmic_core_field' ) ) {
		return $block_content;
	}

	$style = cozmic_core_field( 'cozmic_banner_style' );

	if ( 'none' === $style ) {
		return '';
	}

	$focus = cozmic_core_field( 'cozmic_banner_focus' );
	$video = cozmic_core_field( 'cozmic_banner_video' );

	if ( '' === $style && '' === $focus && '' === $video ) {
		return $block_content;
	}

	$position = match ( $focus ) {
		'top'    => '50% 20%',
		'bottom' => '50% 80%',
		default  => '',
	};

	$html = new WP_HTML_Tag_Processor( $block_content );

	if ( $html->next_tag( array( 'class_name' => 'wp-block-cover' ) ) ) {
		if ( 'tall' === $style || 'full' === $style ) {
			$inline = (string) preg_replace(
				'/\s*min-height\s*:[^;]*;?/i',
				'',
				(string) $html->get_attribute( 'style' )
			);
			$inline = trim( trim( $inline ), ';' );

			/*
			 * Full height reuses the existing "Fill screen" cover style, which
			 * sizes from CSS and subtracts the header and admin bar. Its own
			 * min-height has to go first, because an inline style beats it.
			 */
			if ( 'tall' === $style ) {
				$inline = '' === $inline ? 'min-height:520px' : $inline . ';min-height:520px';
			} else {
				$html->add_class( 'is-style-cozmic-fill-screen' );
			}

			$html->set_attribute( 'style', $inline );
		}

		if ( '' !== $position ) {
			while ( $html->next_tag( 'img' ) ) {
				$html->set_attribute( 'style', 'object-position:' . $position . ';' );
				$html->set_attribute( 'data-object-position', $position );
			}
		}
	}

	$block_content = $html->get_updated_html();

	if ( '' !== $video ) {
		$block_content = cozmic_banner_video( $block_content, $video, $position );
	}

	return $block_content;
}
add_filter( 'render_block', 'cozmic_banner', 10, 2 );

/**
 * Swap a banner's image background for a looping video.
 *
 * The markup matches what the cover block saves for a video background, so the
 * result styles itself from core's own stylesheet with nothing added here.
 *
 * Spliced by offset rather than with `preg_replace`, because the replacement
 * carries a client-supplied URL and a `$1` inside one would be read as a
 * backreference.
 *
 * @param string $html     Rendered cover HTML.
 * @param string $url      Video URL.
 * @param string $position CSS object-position, or an empty string for the default.
 */
function cozmic_banner_video( string $html, string $url, string $position ): string {
	$html = (string) preg_replace( '/<img[^>]*wp-block-cover__image-background[^>]*>/', '', $html, 1 );

	$video = sprintf(
		'<video class="wp-block-cover__video-background intrinsic-ignore" autoplay muted loop playsinline src="%s" data-object-fit="cover"%s></video>',
		esc_url( $url ),
		'' === $position
			? ''
			: sprintf( ' style="object-position:%s" data-object-position="%s"', esc_attr( $position ), esc_attr( $position ) )
	);

	if ( 1 === preg_match( '/<div\b[^>]*wp-block-cover__inner-container/', $html, $match, PREG_OFFSET_CAPTURE ) ) {
		$offset = (int) $match[0][1];

		return substr( $html, 0, $offset ) . $video . substr( $html, $offset );
	}

	return $html;
}

/**
 * What the archive being viewed has been set to look like.
 *
 * An archive has no post behind it, so its banner image, introduction and
 * layout come from Cozmic Core's Content Pages settings instead of from meta.
 * Returns an empty array anywhere that question does not apply, which is what
 * every caller below checks first.
 *
 * @return array<string, string>
 */
function cozmic_archive_settings(): array {
	static $cache = null;

	if ( null !== $cache ) {
		return $cache;
	}

	$cache = array();

	if ( ! is_post_type_archive() || ! function_exists( 'cozmic_core_archive' ) || ! function_exists( 'cozmic_core_post_types' ) ) {
		return $cache;
	}

	$object = get_queried_object();
	if ( ! $object instanceof WP_Post_Type ) {
		return $cache;
	}

	$slug = cozmic_core_post_types()[ $object->name ] ?? '';
	if ( '' === $slug ) {
		return $cache;
	}

	$cache = array(
		'image'  => cozmic_core_archive( $slug, 'image' ),
		'intro'  => cozmic_core_archive( $slug, 'intro' ),
		'layout' => cozmic_core_archive( $slug, 'layout' ),
	);

	return $cache;
}

/**
 * Put the archive's chosen image behind its banner.
 *
 * The cover cannot use `useFeaturedImage` here the way a single's banner does,
 * because an archive has no featured image to use. The image is inserted the
 * same way core inserts a featured one: between the overlay and the inner
 * container, so core's own stylesheet positions and dims it with nothing added.
 *
 * Resolved back to an attachment where possible, so the markup carries a srcset
 * and a phone downloads a phone-sized file. A URL from outside the library still
 * works, it just ships one size.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Parsed block.
 */
function cozmic_archive_banner( string $block_content, array $block ): string {
	if ( 'core/cover' !== ( $block['blockName'] ?? '' ) || ! cozmic_block_has_class( $block, 'cz-archive-banner' ) ) {
		return $block_content;
	}

	$url = cozmic_archive_settings()['image'] ?? '';
	if ( '' === $url ) {
		return $block_content;
	}

	$attachment = attachment_url_to_postid( $url );
	$image      = $attachment
		? wp_get_attachment_image(
			$attachment,
			'full',
			false,
			array(
				'class'           => 'wp-block-cover__image-background',
				'data-object-fit' => 'cover',
			)
		)
		: sprintf( '<img class="wp-block-cover__image-background" src="%s" alt="" data-object-fit="cover" />', esc_url( $url ) );

	if ( '' === $image ) {
		return $block_content;
	}

	if ( 1 === preg_match( '/<div\b[^>]*wp-block-cover__inner-container/', $block_content, $match, PREG_OFFSET_CAPTURE ) ) {
		$offset = (int) $match[0][1];

		return substr( $block_content, 0, $offset ) . $image . substr( $block_content, $offset );
	}

	return $block_content;
}
add_filter( 'render_block', 'cozmic_archive_banner', 10, 2 );

/**
 * The archive's introduction, or nothing at all.
 *
 * The paragraph sits in the template carrying placeholder text, because a
 * template cannot ask whether an introduction was written. Here it either gets
 * the real words or is removed outright - an empty paragraph would still take
 * up its margin and leave a gap nobody asked for.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Parsed block.
 */
function cozmic_archive_intro( string $block_content, array $block ): string {
	if ( 'core/paragraph' !== ( $block['blockName'] ?? '' ) || ! cozmic_block_has_class( $block, 'cz-archive-intro' ) ) {
		return $block_content;
	}

	$intro = trim( cozmic_archive_settings()['intro'] ?? '' );

	if ( '' === $intro ) {
		return '';
	}

	return (string) preg_replace_callback(
		'/(<p\b[^>]*>)(.*?)(<\/p>)/s',
		static fn( array $match ) => $match[1] . nl2br( esc_html( $intro ) ) . $match[3],
		$block_content,
		1
	);
}
add_filter( 'render_block', 'cozmic_archive_intro', 10, 2 );

/**
 * The archive's chosen layout.
 *
 * Column count is a block *attribute*, and core generates the grid CSS from it
 * during render - so unlike the banner, this one is set before rendering rather
 * than rewritten after. Filtering the rendered HTML instead would mean parsing
 * and rewriting a generated class name, which is core's to change.
 *
 * "List" is one column here and two columns in the stylesheet: the image beside
 * the text rather than above it. Doing the side-by-side part in CSS keeps the
 * markup identical for every layout, which matters on a stack where content and
 * stylesheet reach a site by different routes at different speeds.
 *
 * @param array $parsed_block Parsed block, before rendering.
 * @return array
 */
function cozmic_archive_layout( array $parsed_block ): array {
	if ( 'core/post-template' !== ( $parsed_block['blockName'] ?? '' ) ) {
		return $parsed_block;
	}

	$layout = cozmic_archive_settings()['layout'] ?? '';
	if ( '' === $layout ) {
		return $parsed_block;
	}

	$columns = 'list' === $layout ? 1 : (int) $layout;
	if ( $columns < 1 || $columns > 4 ) {
		return $parsed_block;
	}

	$parsed_block['attrs']['layout'] = array(
		'type'        => 'grid',
		'columnCount' => $columns,
	);

	return $parsed_block;
}
add_filter( 'render_block_data', 'cozmic_archive_layout' );

/**
 * Tell the stylesheet which archive layout is in play.
 *
 * A body class rather than one on the block: `core/post-template` renders its
 * own container and the class it needs is only ever read by CSS, so there is
 * nothing to gain from threading it through the block's attributes.
 *
 * @param array<int, string> $classes Body classes.
 * @return array<int, string>
 */
function cozmic_archive_body_class( array $classes ): array {
	$layout = cozmic_archive_settings()['layout'] ?? '';

	if ( 'list' === $layout ) {
		$classes[] = 'cz-archive-list';
	}

	return $classes;
}
add_filter( 'body_class', 'cozmic_archive_body_class' );

/**
 * Drop the "read the original" button when there is nothing to read.
 *
 * The button's link is bound to the mention's source URL, and a binding with no
 * value leaves the block's own fallback link in place - which would send a
 * reader somewhere arbitrary. A template cannot ask whether the field is set,
 * so the answer happens here: no link, no button.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Parsed block.
 */
function cozmic_press_source_button( string $block_content, array $block ): string {
	if ( 'core/buttons' !== ( $block['blockName'] ?? '' ) || ! cozmic_block_has_class( $block, 'cz-press-source' ) ) {
		return $block_content;
	}

	if ( ! function_exists( 'cozmic_core_field' ) || '' === cozmic_core_field( 'cozmic_source_url' ) ) {
		return '';
	}

	return $block_content;
}
add_filter( 'render_block', 'cozmic_press_source_button', 10, 2 );

/**
 * Self-hosted updates via GitHub Releases.
 *
 * Plugin Update Checker makes WordPress treat this theme exactly like one from
 * wordpress.org: the update shows in Appearance > Themes and in the Updates
 * screen, and WP's own auto-update toggle works on it.
 *
 * PUC prefers the latest GitHub *Release* over tags or branch tips, which is
 * what makes release tagging the deliberate "tested and ready" gate - commits
 * and pushes reach no client site until a Release exists. The version it
 * compares against is the `Version:` header in style.css, so that header and
 * COZMIC_THEME_VERSION must be bumped together with the tag.
 *
 * No release assets: the repo root *is* the theme root and there is no build
 * step, so GitHub's auto-generated source zip is already a valid theme package.
 * Files marked `export-ignore` in .gitattributes are excluded from it.
 *
 * The theme identity PUC updates comes from the *directory* basename, not the
 * repo name - one more reason the folder must be `cozmic-block-theme`.
 */
function cozmic_init_update_checker(): void {
	// Only the admin and cron ever consult update transients. Loading ~40
	// classes on the front end would tax every client page render for nothing.
	if ( ! is_admin() && ! wp_doing_cron() ) {
		return;
	}

	require_once get_template_directory() . '/lib/plugin-update-checker/plugin-update-checker.php';

	\YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
		'https://github.com/hellocozmic/cozmic-block-theme/',
		get_template_directory() . '/style.css',
		'cozmic-block-theme'
	);
}
add_action( 'after_setup_theme', 'cozmic_init_update_checker' );
