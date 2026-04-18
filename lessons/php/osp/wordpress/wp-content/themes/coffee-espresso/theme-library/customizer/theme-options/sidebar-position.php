<?php
/**
 * Sidebar Position
 *
 * @package coffee_espresso
 */

$wp_customize->add_section(
	'coffee_espresso_sidebar_position',
	array(
		'title' => esc_html__( 'Sidebar Position', 'coffee-espresso' ),
		'panel' => 'coffee_espresso_theme_options',
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_global_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_global_sidebar_separator', array(
	'label' => __( 'Global Sidebar Position', 'coffee-espresso' ),
	'section' => 'coffee_espresso_sidebar_position',
	'settings' => 'coffee_espresso_global_sidebar_separator',
)));

// Sidebar Position - Global Sidebar Position.
$wp_customize->add_setting(
	'coffee_espresso_sidebar_position',
	array(
		'sanitize_callback' => 'coffee_espresso_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'coffee_espresso_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'coffee-espresso' ),
		'section' => 'coffee_espresso_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'coffee-espresso' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'coffee-espresso' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'coffee-espresso' ),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_page_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_page_sidebar_separator', array(
	'label' => __( 'Page Sidebar Position', 'coffee-espresso' ),
	'section' => 'coffee_espresso_sidebar_position',
	'settings' => 'coffee_espresso_page_sidebar_separator',
)));

// Sidebar Position - Page Sidebar Position.
$wp_customize->add_setting(
	'coffee_espresso_page_sidebar_position',
	array(
		'sanitize_callback' => 'coffee_espresso_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'coffee_espresso_page_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'coffee-espresso' ),
		'section' => 'coffee_espresso_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'coffee-espresso' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'coffee-espresso' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'coffee-espresso' ),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_post_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_post_sidebar_separator', array(
	'label' => __( 'Post Sidebar Position', 'coffee-espresso' ),
	'section' => 'coffee_espresso_sidebar_position',
	'settings' => 'coffee_espresso_post_sidebar_separator',
)));

// Sidebar Position - Post Sidebar Position.
$wp_customize->add_setting(
	'coffee_espresso_post_sidebar_position',
	array(
		'sanitize_callback' => 'coffee_espresso_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'coffee_espresso_post_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'coffee-espresso' ),
		'section' => 'coffee_espresso_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'coffee-espresso' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'coffee-espresso' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'coffee-espresso' ),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_sidebar_width_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_sidebar_width_separator', array(
	'label' => __( 'Sidebar Width Setting', 'coffee-espresso' ),
	'section' => 'coffee_espresso_sidebar_position',
	'settings' => 'coffee_espresso_sidebar_width_separator',
)));


$wp_customize->add_setting( 'coffee_espresso_sidebar_width', array(
	'default'           => '30',
	'sanitize_callback' => 'coffee_espresso_sanitize_range_value',
) );

$wp_customize->add_control(new Coffee_Espresso_Customize_Range_Control($wp_customize, 'coffee_espresso_sidebar_width', array(
	'section'     => 'coffee_espresso_sidebar_position',
	'label'       => __( 'Adjust Sidebar Width', 'coffee-espresso' ),
	'description' => __( 'Adjust the width of the sidebar.', 'coffee-espresso' ),
	'input_attrs' => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
)));

$wp_customize->add_setting( 'coffee_espresso_sidebar_widget_font_size', array(
    'default'           => 24,
    'sanitize_callback' => 'absint',
) );

// Add control for site title size
$wp_customize->add_control( 'coffee_espresso_sidebar_widget_font_size', array(
    'type'        => 'number',
    'section'     => 'coffee_espresso_sidebar_position',
    'label'       => __( 'Sidebar Widgets Heading Font Size ', 'coffee-espresso' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
));