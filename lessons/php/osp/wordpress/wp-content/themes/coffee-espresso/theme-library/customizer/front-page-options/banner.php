<?php
/**
 * Banner Section
 *
 * @package coffee_espresso
 */

$wp_customize->add_section(
	'coffee_espresso_banner_section',
	array(
		'panel'    => 'coffee_espresso_front_page_options',
		'title'    => esc_html__( 'Banner Section', 'coffee-espresso' ),
		'priority' => 10,
	)
);

// Banner Section - Enable Section.
$wp_customize->add_setting(
	'coffee_espresso_enable_banner_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_enable_banner_section',
		array(
			'label'    => esc_html__( 'Enable Banner Section', 'coffee-espresso' ),
			'section'  => 'coffee_espresso_banner_section',
			'settings' => 'coffee_espresso_enable_banner_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'coffee_espresso_enable_banner_section',
		array(
			'selector' => '#coffee_espresso_banner_section .section-link',
			'settings' => 'coffee_espresso_enable_banner_section',
		)
	);
}

// Banner Section - Banner Heading.
$wp_customize->add_setting(
	'coffee_espresso_banner_section_heading',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'coffee_espresso_banner_section_heading',
	array(
		'label'           => esc_html__( 'Banner Heading', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_banner_section',
		'settings'        => 'coffee_espresso_banner_section_heading',
		'type'            => 'text',
		'active_callback' => 'coffee_espresso_is_banner_slider_section_enabled',
	)
);

// Banner Section - Button Label.
$wp_customize->add_setting(
	'coffee_espresso_banner_button_label_one',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'coffee_espresso_banner_button_label_one',
	array(
		'label'           => esc_html__( 'Button Label', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_banner_section',
		'settings'        => 'coffee_espresso_banner_button_label_one',
		'type'            => 'text',
		'active_callback' => 'coffee_espresso_is_banner_slider_section_enabled',
	)
);

// Banner Section - Button Link.
$wp_customize->add_setting(
	'coffee_espresso_banner_button_link_one',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'coffee_espresso_banner_button_link_one',
	array(
		'label'           => esc_html__( 'Button Link', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_banner_section',
		'settings'        => 'coffee_espresso_banner_button_link_one',
		'type'            => 'url',
		'active_callback' => 'coffee_espresso_is_banner_slider_section_enabled',
	)
);

// Banner Section - Background Image.
$wp_customize->add_setting(
	'coffee_espresso_banner_section_image',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'coffee_espresso_banner_section_image',
		array(
			'label'           => esc_html__( 'Banner Background Image', 'coffee-espresso' ),
			'section'         => 'coffee_espresso_banner_section',
			'active_callback' => 'coffee_espresso_is_banner_slider_section_enabled',
		)
	)
);