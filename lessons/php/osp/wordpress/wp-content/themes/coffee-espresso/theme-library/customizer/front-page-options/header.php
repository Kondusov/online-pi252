<?php
/**
 * Header Section Settings
 *
 * @package coffee_espresso
 */

// ---------------------------------------- HEADER OPTIONS ----------------------------------------------------

$wp_customize->add_section(
	'coffee_espresso_header_options',
	array(
		'panel' => 'coffee_espresso_front_page_options',
		'title' => esc_html__( 'Header Options', 'coffee-espresso' ),
        'priority' => 1,
	)
);


// Enable Banner Section
$wp_customize->add_setting(
	'coffee_espresso_enable_topbar',
	array(
		'default'           => false,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_enable_topbar',
		array(
			'label'    => esc_html__( 'Enable Topbar', 'coffee-espresso' ),
			'section'  => 'coffee_espresso_header_options',
			'settings' => 'coffee_espresso_enable_topbar',
		)
	)
);

// Header Options 
$wp_customize->add_setting(
	'coffee_espresso_discount_topbar_text',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'coffee_espresso_discount_topbar_text',
	array(
		'label'           => esc_html__( 'Topbar Welcome Text', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_header_options',
		'type'            => 'text',
		'active_callback' => 'coffee_espresso_is_topbar_enabled',
	)
);




// Header Options 
$wp_customize->add_setting(
	'coffee_espresso_topbar_email',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'coffee_espresso_topbar_email',
	array(
		'label'           => esc_html__( 'Topbar Email', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_header_options',
		'type'            => 'text',
		'active_callback' => 'coffee_espresso_is_topbar_enabled',
	)
);

// Header Options 
$wp_customize->add_setting(
	'coffee_espresso_location_view_button_text',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'coffee_espresso_location_view_button_text',
	array(
		'label'           => esc_html__( 'Topbar Address Text', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_header_options',
		'type'            => 'text',
		'active_callback' => 'coffee_espresso_is_topbar_enabled',
	)
);

// Header Options 
$wp_customize->add_setting(
	'coffee_espresso_location_view_button_url',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'coffee_espresso_location_view_button_url',
	array(
		'label'           => esc_html__( 'Topbar Address URL', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_header_options',
		'type'            => 'text',
		'active_callback' => 'coffee_espresso_is_topbar_enabled',
	)
);



// Header Options 
$wp_customize->add_setting(
	'coffee_espresso_order_view_button_text',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'coffee_espresso_order_view_button_text',
	array(
		'label'           => esc_html__( 'Header Button Text', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_header_options',
		'type'            => 'text',
		'active_callback' => 'coffee_espresso_is_topbar_enabled',
	)
);

// Header Options 
$wp_customize->add_setting(
	'coffee_espresso_order_view_button_url',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'coffee_espresso_order_view_button_url',
	array(
		'label'           => esc_html__( 'Header Button URL', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_header_options',
		'type'            => 'text',
		'active_callback' => 'coffee_espresso_is_topbar_enabled',
	)
);



// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_menu_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_menu_separator', array(
	'label' => __( 'Menu Settings', 'coffee-espresso' ),
	'section' => 'coffee_espresso_header_options',
	'settings' => 'coffee_espresso_menu_separator',
)));

$wp_customize->add_setting( 'coffee_espresso_menu_font_size', array(
    'default'           => 14,
    'sanitize_callback' => 'absint',
));

// Add control for site title size
$wp_customize->add_control( 'coffee_espresso_menu_font_size', array(
    'type'        => 'number',
    'section'     => 'coffee_espresso_header_options',
    'label'       => __( 'Menu Font Size ', 'coffee-espresso' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
));

// Add setting for menu font weight
$wp_customize->add_setting('coffee_espresso_menu_font_weight', array(
    'default'           => '400',
    'sanitize_callback' => 'sanitize_text_field',
));

// Add control for menu font weight
$wp_customize->add_control('coffee_espresso_menu_font_weight', array(
    'type'     => 'select',
    'section'  => 'coffee_espresso_header_options', 
    'label'    => __('Menu Font Weight', 'coffee-espresso'),
    'choices'  => array(
		'100' => __('100','coffee-espresso'),
		'200' => __('200','coffee-espresso'),
		'300' => __('300','coffee-espresso'),
		'400' => __('400','coffee-espresso'),
		'500' => __('500','coffee-espresso'),
		'600' => __('600','coffee-espresso'),
		'700' => __('700','coffee-espresso'),
		'800' => __('800','coffee-espresso'),
		'900' => __('900','coffee-espresso'),
    ),
));

$wp_customize->add_setting( 'coffee_espresso_menu_text_transform', array(
    'default'           => 'capitalize', // Default value for text transform
    'sanitize_callback' => 'sanitize_text_field',
) );

// Add control for menu text transform
$wp_customize->add_control( 'coffee_espresso_menu_text_transform', array(
    'type'     => 'select',
    'section'  => 'coffee_espresso_header_options', // Adjust the section as needed
    'label'    => __( 'Menu Text Transform', 'coffee-espresso' ),
    'choices'  => array(
        'none'       => __( 'None', 'coffee-espresso' ),
        'capitalize' => __( 'Capitalize', 'coffee-espresso' ),
        'uppercase'  => __( 'Uppercase', 'coffee-espresso' ),
        'lowercase'  => __( 'Lowercase', 'coffee-espresso' ),
    ),
) );

// Menu Text Color 
$wp_customize->add_setting(
	'coffee_espresso_menu_text_color', 
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, 
		'coffee_espresso_menu_text_color', 
		array(
			'label' => __('Menu Color', 'coffee-espresso'),
			'section' => 'coffee_espresso_header_options',
		)
	)
);

// Sub Menu Text Color 
$wp_customize->add_setting(
	'coffee_espresso_sub_menu_text_color', 
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, 
		'coffee_espresso_sub_menu_text_color', 
		array(
			'label' => __('Sub Menu Color', 'coffee-espresso'),
			'section' => 'coffee_espresso_header_options',
		)
	)
);

// Topbar Padding Setting
$wp_customize->add_setting('coffee_espresso_topbar_padding',array(
		'default' => '',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control('coffee_espresso_topbar_padding',array(
		'label' => __('Topbar Padding','coffee-espresso'),
		'section' => 'coffee_espresso_header_options',
		'type' => 'number',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1
		)
	)
);