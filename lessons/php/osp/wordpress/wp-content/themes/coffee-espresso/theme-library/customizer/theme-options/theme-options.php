<?php
/**
 * Header Options
 *
 * @package coffee_espresso
 */

// ---------------------------------------- GENERAL OPTIONBS ----------------------------------------------------
// ---------------------------------------- PRELOADER ----------------------------------------------------

$wp_customize->add_section(
	'coffee_espresso_general_options',
	array(
		'panel' => 'coffee_espresso_theme_options',
		'title' => esc_html__( 'General Options', 'coffee-espresso' ),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_preloader_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_preloader_separator', array(
	'label' => __( 'Enable / Disable Site Preloader Section', 'coffee-espresso' ),
	'section' => 'coffee_espresso_general_options',
	'settings' => 'coffee_espresso_preloader_separator',
) ) );


// General Options - Enable Preloader.
$wp_customize->add_setting(
	'coffee_espresso_enable_preloader',
	array(
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_enable_preloader',
		array(
			'label'   => esc_html__( 'Enable Preloader', 'coffee-espresso' ),
			'section' => 'coffee_espresso_general_options',
		)
	)
);

// Preloader Style Setting
$wp_customize->add_setting(
	'coffee_espresso_preloader_style',
	array(
		'default'           => 'style1',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'coffee_espresso_preloader_style',
	array(
		'type'     => 'select',
		'label'    => esc_html__('Select Preloader Styles', 'coffee-espresso'),
		'active_callback' => 'coffee_espresso_is_preloader_style',
		'section'  => 'coffee_espresso_general_options',
		'choices'  => array(
			'style1' => esc_html__('Style 1', 'coffee-espresso'),
			'style2' => esc_html__('Style 2', 'coffee-espresso'),
			'style3' => esc_html__('Style 3', 'coffee-espresso'),
		),
	)
);

// Preloader Background Color Setting
$wp_customize->add_setting(
	'coffee_espresso_preloader_background_color_setting',
	 array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, 'coffee_espresso_preloader_background_color_setting', 
		array(
			'label' => __('Preloader Background Color', 'coffee-espresso'),
			'active_callback' => 'coffee_espresso_is_preloader_style',
			'section' => 'coffee_espresso_general_options',
		)
	)
);

// Preloader Background Image Setting
$wp_customize->add_setting(
	'coffee_espresso_preloader_background_image_setting', 
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize, 'coffee_espresso_preloader_background_image_setting',
		 array(
			'label' => __('Preloader Background Image', 'coffee-espresso'),
			'active_callback' => 'coffee_espresso_is_preloader_style',
			'section' => 'coffee_espresso_general_options',
		)
	)
);

// ---------------------------------------- Website layout ----------------------------------------------------


// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_layuout_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_layuout_separator', array(
	'label' => __( 'Website Layout Setting', 'coffee-espresso' ),
	'section' => 'coffee_espresso_general_options',
	'settings' => 'coffee_espresso_layuout_separator',
)));


$wp_customize->add_setting(
	'coffee_espresso_website_layout',
	array(
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_website_layout',
		array(
			'label'   => esc_html__('Boxed Layout', 'coffee-espresso'),
			'section' => 'coffee_espresso_general_options',
		)
	)
);

$wp_customize->add_setting('coffee_espresso_layout_width_margin', array(
	'default'           => 50,
	'sanitize_callback' => 'coffee_espresso_sanitize_range_value',
));

$wp_customize->add_control(new Coffee_Espresso_Customize_Range_Control($wp_customize, 'coffee_espresso_layout_width_margin', array(
		'label'       => __('Set Width', 'coffee-espresso'),
		'description' => __('Adjust the width around the website layout by moving the slider. Use this setting to customize the appearance of your site to fit your design preferences.', 'coffee-espresso'),
		'section'     => 'coffee_espresso_general_options',
		'settings'    => 'coffee_espresso_layout_width_margin',
		'active_callback' => 'coffee_espresso_is_layout_enabled',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 130,
			'step' => 1,
		),
)));

// ---------------------------------------- BREADCRUMB ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_breadcrumb_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_breadcrumb_separators', array(
	'label' => __( 'Enable / Disable Breadcrumb Section', 'coffee-espresso' ),
	'section' => 'coffee_espresso_general_options',
	'settings' => 'coffee_espresso_breadcrumb_separators',
)));

// Breadcrumb - Enable Breadcrumb.
$wp_customize->add_setting(
	'coffee_espresso_enable_breadcrumb',
	array(
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_enable_breadcrumb',
		array(
			'label'   => esc_html__( 'Enable Breadcrumb', 'coffee-espresso' ),
			'section' => 'coffee_espresso_general_options',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'coffee_espresso_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'coffee_espresso_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'coffee-espresso' ),
		'active_callback' => 'coffee_espresso_is_breadcrumb_enabled',
		'section'         => 'coffee_espresso_general_options',
	)
);

// ----------------------------------------SITE IDENTITY----------------------------------------------------

// Site Logo - Enable Setting.
$wp_customize->add_setting(
	'coffee_espresso_enable_site_logo',
	array(
		'default'           => true, // Default is to display the logo.
		'sanitize_callback' => 'coffee_espresso_sanitize_switch', // Sanitize using a custom switch function.
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_enable_site_logo',
		array(
			'label'    => esc_html__( 'Enable Site Logo', 'coffee-espresso' ),
			'section'  => 'title_tagline', // Section to add this control.
			'settings' => 'coffee_espresso_enable_site_logo',
		)
	)
);

// Site Title - Enable Setting.
$wp_customize->add_setting(
	'coffee_espresso_enable_site_title_setting',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_enable_site_title_setting',
		array(
			'label'    => esc_html__( 'Enable Site Title', 'coffee-espresso' ),
			'section'  => 'title_tagline',
			'settings' => 'coffee_espresso_enable_site_title_setting',
		)
	)
);

// Tagline - Enable Setting.
$wp_customize->add_setting(
	'coffee_espresso_enable_tagline_setting',
	array(
		'default'           => false,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_enable_tagline_setting',
		array(
			'label'    => esc_html__( 'Enable Tagline', 'coffee-espresso' ),
			'section'  => 'title_tagline',
			'settings' => 'coffee_espresso_enable_tagline_setting',
		)
	)
);

$wp_customize->add_setting( 'coffee_espresso_site_title_size', array(
    'default'           => 20, // Default font size in pixels
    'sanitize_callback' => 'absint', // Sanitize the input as a positive integer
) );

// Add control for site title size
$wp_customize->add_control( 'coffee_espresso_site_title_size', array(
    'type'        => 'number',
    'section'     => 'title_tagline', // You can change this section to your preferred section
    'label'       => __( 'Site Title Font Size ', 'coffee-espresso' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
) );

$wp_customize->add_setting('coffee_espresso_site_logo_width', array(
    'default'           => 150,
    'sanitize_callback' => 'coffee_espresso_sanitize_range_value',
));

$wp_customize->add_control(new Coffee_Espresso_Customize_Range_Control($wp_customize, 'coffee_espresso_site_logo_width', array(
    'label'       => __('Adjust Site Logo Width', 'coffee-espresso'),
    'description' => __('This setting controls the Width of Site Logo', 'coffee-espresso'),
    'section'     => 'title_tagline',
    'settings'    => 'coffee_espresso_site_logo_width',
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 400,
        'step' => 5,
    ),
)));

// ---------------------------------------- ANIMATION ----------------------------------------------------

$wp_customize->add_setting( 'coffee_espresso_animation_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_animation_separator', array(
	'label' => __( 'Enable / Disable Animation', 'coffee-espresso' ),
	'section' => 'coffee_espresso_general_options',
	'settings' => 'coffee_espresso_animation_separator',
) ) );
// Animation Enable / Disable
$wp_customize->add_setting(
	'coffee_espresso_enable_animation',array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);
$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control($wp_customize,'coffee_espresso_enable_animation',array(
			'label'   => esc_html__( 'Enable Animation', 'coffee-espresso' ),
			'section' => 'coffee_espresso_general_options',
		)
	)
);