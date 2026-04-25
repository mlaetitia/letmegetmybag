<?php
/**
 * Commonplace theme functions and definitions.
 *
 * @package Commonplace
 * @since 0.1.0
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'COMMONPLACE_VERSION' ) ) {
	define( 'COMMONPLACE_VERSION', '0.1.0' );
}

/**
 * Theme setup.
 *
 * Most theme features are declared in theme.json. This hook covers anything
 * that cannot be expressed there yet.
 *
 * @return void
 */
function commonplace_setup(): void {
	load_theme_textdomain( 'commonplace', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'commonplace_setup' );

/**
 * Enqueue front-end styles.
 *
 * @return void
 */
function commonplace_enqueue_assets(): void {
	wp_enqueue_style(
		'commonplace-style',
		get_stylesheet_uri(),
		array(),
		COMMONPLACE_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'commonplace_enqueue_assets' );

/**
 * Add a body class for the current category so per-category accent colours
 * can be switched via CSS custom properties.
 *
 * @param array<int, string> $classes Existing body classes.
 * @return array<int, string>
 */
function commonplace_body_class( array $classes ): array {
	if ( is_category() ) {
		$category = get_queried_object();
		if ( $category instanceof WP_Term ) {
			$classes[] = 'category-' . sanitize_html_class( $category->slug );
		}
	}

	if ( is_singular( 'post' ) ) {
		$post_categories = get_the_category();
		if ( ! empty( $post_categories ) ) {
			$classes[] = 'category-' . sanitize_html_class( $post_categories[0]->slug );
		}
	}

	return $classes;
}
add_filter( 'body_class', 'commonplace_body_class' );
