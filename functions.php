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

define( 'COZMIC_THEME_VERSION', '0.2.2' );

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
		'cozmic/services'  => 'cozmic_service',
		'cozmic/events'    => 'cozmic_event',
		'cozmic/portfolio' => 'cozmic_project',
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
