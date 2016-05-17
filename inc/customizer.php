<?php
/**
 * flegfleg-base Theme Customizer.
 *
 * @package flegfleg-base
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function flegfleg_base_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Add our social link options.
    $wp_customize->add_section(
        'flegfleg_base_social_links_section',
        array(
            'title'       => esc_html__( 'Social Links', 'flegfleg-base' ),
            'description' => esc_html__( 'These are the settings for social links. Please limit the number of social links to 5.', 'flegfleg-base' ),
            'priority'    => 90,
        )
    );

    // Create an array of our social links for ease of setup.
    $social_networks = array( 'twitter', 'facebook', 'instagram' );

    // Loop through our networks to setup our fields.
    foreach( $social_networks as $network ) {

	    $wp_customize->add_setting(
	        'flegfleg_base_' . $network . '_link',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'flegfleg_base_sanitize_customizer_url'
	        )
	    );
	    $wp_customize->add_control(
	        'flegfleg_base_' . $network . '_link',
	        array(
	            'label'   => sprintf( esc_html__( '%s Link', 'flegfleg-base' ), ucwords( $network ) ),
	            'section' => 'flegfleg_base_social_links_section',
	            'type'    => 'text',
	        )
	    );
    }

    // Add our Footer Customization section section.
    $wp_customize->add_section(
        'flegfleg_base_footer_section',
        array(
            'title'    => esc_html__( 'Footer Customization', 'flegfleg-base' ),
            'priority' => 90,
        )
    );

    // Add our copyright text field.
    $wp_customize->add_setting(
        'flegfleg_base_copyright_text',
        array(
            'default' => ''
        )
    );
    $wp_customize->add_control(
        'flegfleg_base_copyright_text',
        array(
            'label'       => esc_html__( 'Copyright Text', 'flegfleg-base' ),
            'description' => esc_html__( 'The copyright text will be displayed beneath the menu in the footer.', 'flegfleg-base' ),
            'section'     => 'flegfleg_base_footer_section',
            'type'        => 'text',
            'sanitize'    => 'html'
        )
    );
}
add_action( 'customize_register', 'flegfleg_base_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function flegfleg_base_customize_preview_js() {
    wp_enqueue_script( 'flegfleg_base_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'flegfleg_base_customize_preview_js' );

/**
 * Sanitize our customizer text inputs.
 */
function flegfleg_base_sanitize_customizer_text( $input ) {
    return sanitize_text_field( force_balance_tags( $input ) );
}

/**
 * Sanitize our customizer URL inputs.
 */
function flegfleg_base_sanitize_customizer_url( $input ) {
    return esc_url( $input );
}
