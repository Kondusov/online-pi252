<?php
/**
 * Pige Title Options
 *
 * @package coffee_espresso
 */



$wp_customize->add_section(
	'coffee_espresso_page_title_options',
	array(
		'panel' => 'coffee_espresso_theme_options',
		'title' => esc_html__( 'Page Title', 'coffee-espresso' ),
	)
);

$wp_customize->add_setting(
    'coffee_espresso_page_header_visibility',
    array(
        'default'           => 'all-devices',
        'sanitize_callback' => 'coffee_espresso_sanitize_select',
    )
);

$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'coffee_espresso_page_header_visibility',
        array(
            'label'    => esc_html__( 'Page Header Visibility', 'coffee-espresso' ),
            'type'     => 'select',
            'section'  => 'coffee_espresso_page_title_options',
            'settings' => 'coffee_espresso_page_header_visibility',
            'priority' => 10,
            'choices'  => array(
                'all-devices'        => esc_html__( 'Show on all devices', 'coffee-espresso' ),
                'hide-tablet'        => esc_html__( 'Hide on Tablet', 'coffee-espresso' ),
                'hide-mobile'        => esc_html__( 'Hide on Mobile', 'coffee-espresso' ),
                'hide-tablet-mobile' => esc_html__( 'Hide on Tablet & Mobile', 'coffee-espresso' ),
                'hide-all-devices'   => esc_html__( 'Hide on all devices', 'coffee-espresso' ),
            ),
        )
    )
);


$wp_customize->add_setting( 'coffee_espresso_page_title_background_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_page_title_background_separator', array(
	'label' => __( 'Page Title BG Image & Color Setting', 'coffee-espresso' ),
	'section' => 'coffee_espresso_page_title_options',
	'settings' => 'coffee_espresso_page_title_background_separator',
)));


$wp_customize->add_setting(
	'coffee_espresso_page_header_style',
	array(
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
		'default'           => False,
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_page_header_style',
		array(
			'label'   => esc_html__('Page Title Background Image', 'coffee-espresso'),
			'section' => 'coffee_espresso_page_title_options',
		)
	)
);

$wp_customize->add_setting( 'coffee_espresso_page_header_background_image', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'coffee_espresso_page_header_background_image', array(
    'label'    => __( 'Background Image', 'coffee-espresso' ),
    'section'  => 'coffee_espresso_page_title_options',
	'description' => __('Choose either a background image or a color. If a background image is selected, the background color will not be visible.', 'coffee-espresso'),
    'settings' => 'coffee_espresso_page_header_background_image',
	'active_callback' => 'coffee_espresso_is_pagetitle_bcakground_image_enabled',
)));


$wp_customize->add_setting('coffee_espresso_page_header_image_height', array(
	'default'           => 200,
	'sanitize_callback' => 'coffee_espresso_sanitize_range_value',
));

$wp_customize->add_control(new Coffee_Espresso_Customize_Range_Control($wp_customize, 'coffee_espresso_page_header_image_height', array(
		'label'       => __('Image Height', 'coffee-espresso'),
		'section'     => 'coffee_espresso_page_title_options',
		'settings'    => 'coffee_espresso_page_header_image_height',
		'active_callback' => 'coffee_espresso_is_pagetitle_bcakground_image_enabled',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 1000,
			'step' => 5,
		),
)));


$wp_customize->add_setting('coffee_espresso_page_title_background_color_setting', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'coffee_espresso_page_title_background_color_setting', array(
    'label' => __('Page Title Background Color', 'coffee-espresso'),
    'section' => 'coffee_espresso_page_title_options',
)));

$wp_customize->add_setting('coffee_espresso_pagetitle_height', array(
    'default'           => 50,
    'sanitize_callback' => 'coffee_espresso_sanitize_range_value',
));

$wp_customize->add_control(new Coffee_Espresso_Customize_Range_Control($wp_customize, 'coffee_espresso_pagetitle_height', array(
    'label'       => __('Set Height', 'coffee-espresso'),
    'description' => __('This setting controls the page title height when no background image is set. If a background image is set, this setting will not apply.', 'coffee-espresso'),
    'section'     => 'coffee_espresso_page_title_options',
    'settings'    => 'coffee_espresso_pagetitle_height',
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 300,
        'step' => 5,
    ),
)));


$wp_customize->add_setting( 'coffee_espresso_page_title_style_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_page_title_style_separator', array(
	'label' => __( 'Page Title Styling Setting', 'coffee-espresso' ),
	'section' => 'coffee_espresso_page_title_options',
	'settings' => 'coffee_espresso_page_title_style_separator',
)));

$wp_customize->add_setting( 'coffee_espresso_page_header_heading_tag', array(
	'default'   => 'h1',
	'sanitize_callback' => 'coffee_espresso_sanitize_select',
) );

$wp_customize->add_control( 'coffee_espresso_page_header_heading_tag', array(
	'label'   => __( 'Page Title Heading Tag', 'coffee-espresso' ),
	'section' => 'coffee_espresso_page_title_options',
	'type'    => 'select',
	'choices' => array(
		'h1' => __( 'H1', 'coffee-espresso' ),
		'h2' => __( 'H2', 'coffee-espresso' ),
		'h3' => __( 'H3', 'coffee-espresso' ),
		'h4' => __( 'H4', 'coffee-espresso' ),
		'h5' => __( 'H5', 'coffee-espresso' ),
		'h6' => __( 'H6', 'coffee-espresso' ),
		'p' => __( 'p', 'coffee-espresso' ),
		'a' => __( 'a', 'coffee-espresso' ),
		'div' => __( 'div', 'coffee-espresso' ),
		'span' => __( 'span', 'coffee-espresso' ),
	),
) );

$wp_customize->add_setting('coffee_espresso_page_header_layout', array(
	'default' => 'left',
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('coffee_espresso_page_header_layout', array(
	'label' => __('Style', 'coffee-espresso'),
	'section' => 'coffee_espresso_page_title_options',
	'description' => __('"Flex Layout Style" wont work below 600px (mobile media)', 'coffee-espresso'),
	'settings' => 'coffee_espresso_page_header_layout',
	'type' => 'radio',
	'choices' => array(
		'left' => __('Classic', 'coffee-espresso'),
		'right' => __('Aligned Right', 'coffee-espresso'),
		'center' => __('Centered Focus', 'coffee-espresso'),
		'flex' => __('Flex Layout', 'coffee-espresso'),
	),
));