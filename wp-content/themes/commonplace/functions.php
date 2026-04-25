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
	 * Registers block binding sources used by templates and patterns.
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

		register_block_bindings_source(
			'commonplace/reading-time',
			array(
				'label'              => __( 'Reading time', 'commonplace' ),
				'get_value_callback' => 'commonplace_reading_time_binding',
			)
		);
	}
endif;
add_action( 'init', 'commonplace_register_block_bindings' );

// Reading-time block binding callback.
if ( ! function_exists( 'commonplace_reading_time_binding' ) ) :
	/**
	 * Returns "X min read" for the current post, based on a 200-words-per-minute
	 * reading speed. Used as the get_value_callback for the
	 * `commonplace/reading-time` block binding.
	 *
	 * @since Commonplace 0.1.0
	 *
	 * @return string
	 */
	function commonplace_reading_time_binding() {
		$post_id = get_the_ID();
		if ( ! $post_id ) {
			return '';
		}

		$content = get_post_field( 'post_content', $post_id );
		$words   = str_word_count( wp_strip_all_tags( (string) $content ) );
		$minutes = max( 1, (int) ceil( $words / 200 ) );

		/* translators: %d: number of minutes to read the post. */
		return sprintf( _n( '%d min read', '%d min read', $minutes, 'commonplace' ), $minutes );
	}
endif;

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

// Pre-paint dim-mode boot snippet, inlined in <head> to avoid FOUC.
if ( ! function_exists( 'commonplace_dim_mode_inline' ) ) :
	/**
	 * Outputs an inline snippet in <head> that reads the user's dim-mode
	 * preference (localStorage, falling back to prefers-color-scheme) and
	 * sets <html data-theme="..."> before paint.
	 *
	 * The full toggle helper lives in assets/js/dim-mode.js, which is
	 * enqueued non-blocking; this inline is just for initial state.
	 *
	 * @since Commonplace 0.1.0
	 *
	 * @return void
	 */
	function commonplace_dim_mode_inline() {
		?>
<script>
(function(){
	try {
		var stored = localStorage.getItem('commonplaceTheme');
		var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
		var mode = stored || (prefersDark ? 'dim' : 'cream');
		document.documentElement.setAttribute('data-theme', mode);
	} catch (e) { /* localStorage unavailable */ }
})();
</script>
		<?php
	}
endif;
add_action( 'wp_head', 'commonplace_dim_mode_inline', 1 );

// Enqueues the dim-mode toggle helper (used by future toggle buttons).
if ( ! function_exists( 'commonplace_enqueue_scripts' ) ) :
	/**
	 * Enqueues theme JavaScript on the front end.
	 *
	 * @since Commonplace 0.1.0
	 *
	 * @return void
	 */
	function commonplace_enqueue_scripts() {
		wp_enqueue_script(
			'commonplace-dim-mode',
			get_parent_theme_file_uri( 'assets/js/dim-mode.js' ),
			array(),
			wp_get_theme()->get( 'Version' ),
			array(
				'in_footer' => false,
				'strategy'  => 'defer',
			)
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'commonplace_enqueue_scripts' );
