<?php
/**
 * Custom scripts and styles.
 *
 * @package flegfleg-base
 */

/**
 * Register Google font.
 *
 * @link http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 */
function flegfleg_base_font_url() {

	$fonts_url = '';

	$font_families = array(
		'Karla:400,400italic,700,700italic',
		'Open Sans:400,300,700',
		'Cousine:400,700,400italic,700italic'
	);

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
	);
	
	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function flegfleg_base_scripts() {
	/**
	 * If WP is in script debug, or we pass ?script_debug in a URL - set debug to true.
	 */
	$debug = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG == true ) || ( isset( $_GET['script_debug'] ) ) ? true : false;

	/**
	 * If we are debugging the site, use a unique version every page load so as to ensure no cache issues.
	 */
	$version = '1.0.0';

	/**
	 * Should we load minified files?
	 */
	$suffix = ( true === $debug ) ? '' : '.min';

	// Register styles.
	wp_register_style( 'flegfleg-base-google-font', flegfleg_base_font_url(), array(), null );

	// Enqueue styles.
	wp_enqueue_style( 'flegfleg-base-google-font' );
	wp_enqueue_style( 'animate.css' );
	wp_enqueue_style( 'flegfleg-base-style', get_stylesheet_directory_uri() . '/style' . $suffix . '.css', array(), $version );

	// Enqueue scripts.
	wp_enqueue_script( 'flegfleg-base-scripts', get_template_directory_uri() . '/assets/js/project' . $suffix . '.js', array( 'jquery' ), $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'flegfleg_base_scripts' );


if ( class_exists( 'WDS_Simple_Page_Builder' ) && version_compare( WDS_Simple_Page_Builder::VERSION, '1.6', '>=' ) ) :

	/**
	 * Conditionally enqueue styles & scripts via Page Builder.
	 */
	function flegfleg_base_enqueue_page_builder_scripts() {

		// Get the page builder parts
		$parts = get_page_builder_parts();

		// // If page builder part exsists, enqueue script
		// if ( in_array( 'cover-flow' , $parts ) ) {
		// 	wp_register_script( 'cover-flow', get_stylesheet_directory_uri() . '/js/cover-flow-script.js', array(), $version, true );
		// 	wp_enqueue_script( 'cover-flow' );
		// }

	}
	add_action( 'wds_page_builder_after_load_parts', 'flegfleg_base_enqueue_page_builder_scripts' );

endif;

/**
 * Add SVG definitions to <head>.
 */
function flegfleg_base_include_svg_icons() {

	// Define SVG sprite file.
	$svg_icons = get_template_directory() . '/assets/images/svg-icons.svg';

	// If it exsists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}
}
