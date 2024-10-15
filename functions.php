<?php
/**
 * This file adds functions to the pasigraphy WordPress theme.
 *
 * @package pasigraphy
 * @author  WP Engine
 * @license GNU General Public License v3
 * @link    https://pasigraphywp.com/
 */

if ( ! function_exists( 'pasigraphy_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 0.8.0
	 *
	 * @return void
	 */
	function pasigraphy_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'pasigraphy', get_template_directory() . '/languages' );

		// Enqueue editor stylesheet.
		add_editor_style( get_template_directory_uri() . '/style.css' );

		// Remove core block patterns.
		remove_theme_support( 'core-block-patterns' );

	}
}
add_action( 'after_setup_theme', 'pasigraphy_setup' );

// Enqueue stylesheet.
add_action( 'wp_enqueue_scripts', 'pasigraphy_enqueue_stylesheet' );
function pasigraphy_enqueue_stylesheet() {

	wp_enqueue_style( 'pasigraphy', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

}

/**
 * Register block styles.
 *
 * @since 0.9.2
 */
function pasigraphy_register_block_styles() {

	$block_styles = array(
		'core/columns' => array(
			'columns-reverse' => __( 'Reverse', 'pasigraphy' ),
		),
		'core/group' => array(
			'shadow-light' => __( 'Shadow', 'pasigraphy' ),
			'shadow-solid' => __( 'Solid', 'pasigraphy' ),
		),
		'core/list' => array(
			'no-disc' => __( 'No Disc', 'pasigraphy' ),
		),
		'core/quote' => array(
			'shadow-light' => __( 'Shadow', 'pasigraphy' ),
			'shadow-solid' => __( 'Solid', 'pasigraphy' ),
		),
		'core/social-links' => array(
			'outline' => __( 'Outline', 'pasigraphy' ),
		),
	);

	foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name'  => $style_name,
					'label' => $style_label,
				)
			);
		}
	}
}
add_action( 'init', 'pasigraphy_register_block_styles' );

/**
 * Register block pattern categories.
 *
 * @since 1.0.4
 */
function pasigraphy_register_block_pattern_categories() {

	register_block_pattern_category(
		'pasigraphy-page',
		array(
			'label'       => __( 'Page', 'pasigraphy' ),
			'description' => __( 'Create a full page with multiple patterns that are grouped together.', 'pasigraphy' ),
		)
	);
	register_block_pattern_category(
		'pasigraphy-pricing',
		array(
			'label'       => __( 'Pricing', 'pasigraphy' ),
			'description' => __( 'Compare features for your digital products or service plans.', 'pasigraphy' ),
		)
	);

}

add_action( 'init', 'pasigraphy_register_block_pattern_categories' );
