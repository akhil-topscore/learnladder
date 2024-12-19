<?php
/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @link https://codex.wordpress.org/Theme_Customization_API
 * 
 * @package TopscoreWP
 */
function topscorewp_customize( $wp_customize ) {
	/**
	 * Initialize sections
	 */

	// Topbar
	$wp_customize->add_section(
		'theme_topbar_section',
		array(
			'title'    => __( 'Top Bar', 'topscorewp' ),
			'priority' => 100,
		)
	);

	// Header
	$wp_customize->add_section(
		'theme_header_section',
		array(
			'title'    => __( 'Header', 'topscorewp' ),
			'priority' => 100,
		)
	);

	/**
	 * Section: Page Layout
	 */
	// Topbar.
	$wp_customize->add_setting(
		'topbar_enabled',
		array(
			'default'           => '1',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'topbar_enabled',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Show Topbar', 'topscorewp' ),
			'section'  => 'theme_topbar_section',
			'settings' => 'topbar_enabled',
			'priority' => 1,
		)
	);

	// Notice.
	$wp_customize->add_setting(
		'notice_field',
		array(
			'default'           => 'Notice',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'notice_field',
		array(
			'type'     => 'text',
			'label'    => __( 'Notice', 'topscorewp' ),
			'section'  => 'theme_topbar_section',
			'settings' => 'notice_field',
			'priority' => 2,
		)
	);

	// Email.
	$wp_customize->add_setting(
		'email_text',
		array(
			'default'           => 'Email Text',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'email_text',
		array(
			'type'     => 'text',
			'label'    => __( 'Email Text', 'topscorewp' ),
			'section'  => 'theme_header_section',
			'settings' => 'email_text',
			'priority' => 2,
		)
	);
	$wp_customize->add_setting(
		'email_field',
		array(
			'default'           => 'example.mail.com',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'email_field',
		array(
			'type'     => 'email',
			'label'    => __( 'Email', 'topscorewp' ),
			'section'  => 'theme_header_section',
			'settings' => 'email_field',
			'priority' => 2,
		)
	);

	// Tel.
	$wp_customize->add_setting(
		'tel_text',
		array(
			'default'           => 'Call Text',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'tel_text',
		array(
			'type'     => 'text',
			'label'    => __( 'Call Text', 'topscorewp' ),
			'section'  => 'theme_header_section',
			'settings' => 'tel_text',
			'priority' => 2,
		)
	);
	$wp_customize->add_setting(
		'tel_field',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'tel_field',
		array(
			'type'     => 'tel',
			'label'    => __( 'Call', 'topscorewp' ),
			'section'  => 'theme_header_section',
			'settings' => 'tel_field',
			'priority' => 3,
		)
	);

	// Address.
	$wp_customize->add_setting(
		'address_text',
		array(
			'default'           => 'Address Text',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'address_text',
		array(
			'type'     => 'text',
			'label'    => __( 'Address Text', 'topscorewp' ),
			'section'  => 'theme_header_section',
			'settings' => 'address_text',
			'priority' => 4,
		)
	);
	$wp_customize->add_setting(
		'address_field',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'address_field',
		array(
			'type'     => 'text',
			'label'    => __( 'Address', 'topscorewp' ),
			'section'  => 'theme_header_section',
			'settings' => 'address_field',
			'priority' => 4,
		)
	);
	// Header Logo.
	// $wp_customize->add_setting(
	// 	'header_logo',
	// 	array(
	// 		'default'           => '',
	// 		'sanitize_callback' => 'esc_url_raw',
	// 	)
	// );
	// $wp_customize->add_control(
	// 	new WP_Customize_Image_Control(
	// 		$wp_customize,
	// 		'header_logo',
	// 		array(
	// 			'label'       => __( 'Upload Header Logo', 'topscorewp' ),
	// 			'description' => __( 'Height: &gt;80px', 'topscorewp' ),
	// 			'section'     => 'theme_header_section',
	// 			'settings'    => 'header_logo',
	// 			'priority'    => 1,
	// 		)
	// 	)
	// );

	// Predefined Navbar scheme.
	// $wp_customize->add_setting(
	// 	'navbar_scheme',
	// 	array(
	// 		'default'           => 'default',
	// 		'sanitize_callback' => 'sanitize_text_field',
	// 	)
	// );
	// $wp_customize->add_control(
	// 	'navbar_scheme',
	// 	array(
	// 		'type'     => 'radio',
	// 		'label'    => __( 'Navbar Scheme', 'topscorewp' ),
	// 		'section'  => 'theme_header_section',
	// 		'choices'  => array(
	// 			'navbar-light bg-light'  => __( 'Default', 'topscorewp' ),
	// 			'navbar-dark bg-dark'    => __( 'Dark', 'topscorewp' ),
	// 			'navbar-dark bg-primary' => __( 'Primary', 'topscorewp' ),
	// 		),
	// 		'settings' => 'navbar_scheme',
	// 		'priority' => 1,
	// 	)
	// );
}
add_action( 'customize_register', 'topscorewp_customize' );
