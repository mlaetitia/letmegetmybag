<?php
/**
 * Commonplace functions and definitions.
 *
 * Forked from the Twenty Twenty-Five WordPress Theme (GPLv2 or later).
 * https://wordpress.org/themes/twentytwentyfive/
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Commonplace
 * @since Commonplace 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'COMMONPLACE_VERSION' ) ) {
	define( 'COMMONPLACE_VERSION', '0.1.0' );
}

// Adds theme support for post formats.
if ( ! function_exists( 'commonplace_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Commonplace 0.1.0
	 *
	 * @return void
	 */
	function commonplace_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'commonplace_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'commonplace_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Commonplace 0.1.0
	 *
	 * @return void
	 */
	function commonplace_editor_style() {
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'commonplace_editor_style' );

// Enqueues the theme stylesheet on the front.
if ( ! function_exists( 'commonplace_enqueue_styles' ) ) :
	/**
	 * Enqueues the theme stylesheet on the front.
	 *
	 * @since Commonplace 0.1.0
	 *
	 * @return void
	 */
	function commonplace_enqueue_styles() {
		$suffix = SCRIPT_DEBUG ? '' : '.min';
		$src    = 'style' . $suffix . '.css';

		wp_enqueue_style(
			'commonplace-style',
			get_parent_theme_file_uri( $src ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
		wp_style_add_data(
			'commonplace-style',
			'path',
			get_parent_theme_file_path( $src )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'commonplace_enqueue_styles' );

// Registers custom block styles.
if ( ! function_exists( 'commonplace_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Commonplace 0.1.0
	 *
	 * @return void
	 */
	function commonplace_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'commonplace' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'commonplace_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'commonplace_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Commonplace 0.1.0
	 *
	 * @return void
	 */
	function commonplace_pattern_categories() {

		register_block_pattern_category(
			'commonplace_page',
			array(
				'label'       => __( 'Pages', 'commonplace' ),
				'description' => __( 'A collection of full page layouts.', 'commonplace' ),
			)
		);

		register_block_pattern_category(
			'commonplace_post-format',
			array(
				'label'       => __( 'Post formats', 'commonplace' ),
				'description' => __( 'A collection of post format patterns.', 'commonplace' ),
			)
		);
	}
endif;
add_action( 'init', 'commonplace_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'commonplace_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Commonplace 0.1.0
	 *
	 * @return void
	 */
	function commonplace_register_block_bindings() {
		register_block_bindings_source(
			'commonplace/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'commonplace' ),
				'get_value_callback' => 'commonplace_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'commonplace_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'commonplace_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Commonplace 0.1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function commonplace_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

// Adds a category-based body class so per-section accent colours can be
// switched via CSS custom properties (see style.css).
if ( ! function_exists( 'commonplace_body_class' ) ) :
	/**
	 * Adds a category-<slug> class to the body element when viewing a category
	 * archive or a single post belonging to one of the site's flat categories.
	 *
	 * @since Commonplace 0.1.0
	 *
	 * @param array $classes Existing body classes.
	 * @return array
	 */
	function commonplace_body_class( $classes ) {
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
endif;
add_filter( 'body_class', 'commonplace_body_class' );
