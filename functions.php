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

define( 'COZMIC_THEME_VERSION', '0.1.0' );

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
			'name'  => 'cozmic-surface',
			'label' => __( 'Surface panel', 'cozmic-block-theme' ),
		)
	);

	register_block_style(
		'core/details',
		array(
			'name'  => 'cozmic-faq',
			'label' => __( 'FAQ item', 'cozmic-block-theme' ),
		)
	);
}
add_action( 'init', 'cozmic_register_block_styles' );
