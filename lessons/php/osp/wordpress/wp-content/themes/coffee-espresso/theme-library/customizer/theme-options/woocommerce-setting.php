<?php
/**
 * WooCommerce Settings
 *
 * @package coffee_espresso
 */

$wp_customize->add_section(
	'coffee_espresso_woocommerce_settings',
	array(
		'panel' => 'coffee_espresso_theme_options',
		'title' => esc_html__( 'WooCommerce Settings', 'coffee-espresso' ),
	)
);

//WooCommerce - Products per page.
$wp_customize->add_setting( 'coffee_espresso_products_per_page', array(
    'default'           => 9,
    'sanitize_callback' => 'absint',
));

$wp_customize->add_control( 'coffee_espresso_products_per_page', array(
    'type'        => 'number',
    'section'     => 'coffee_espresso_woocommerce_settings',
    'label'       => __( 'Products Per Page', 'coffee-espresso' ),
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
    ),
));

//WooCommerce - Products per row.
$wp_customize->add_setting( 'coffee_espresso_products_per_row', array(
    'default'           => '3',
    'sanitize_callback' => 'coffee_espresso_sanitize_choices',
) );

$wp_customize->add_control( 'coffee_espresso_products_per_row', array(
    'label'    => __( 'Products Per Row', 'coffee-espresso' ),
    'section'  => 'coffee_espresso_woocommerce_settings',
    'settings' => 'coffee_espresso_products_per_row',
    'type'     => 'select',
    'choices'  => array(
        '2' => '2',
		'3' => '3',
		'4' => '4',
    ),
) );

//WooCommerce - Show / Hide Related Product.
$wp_customize->add_setting(
	'coffee_espresso_related_product_show_hide',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_related_product_show_hide',
		array(
			'label'   => esc_html__( 'Show / Hide Related product', 'coffee-espresso' ),
			'section' => 'coffee_espresso_woocommerce_settings',
		)
	)
);

// WooCommerce - Product Sale Position.
$wp_customize->add_setting(
	'coffee_espresso_product_sale_position', 
	array(
		'default' => 'left',
		'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control(
	'coffee_espresso_product_sale_position', 
	array(
		'label' => __('Product Sale Position', 'coffee-espresso'),
		'section' => 'coffee_espresso_woocommerce_settings',
		'settings' => 'coffee_espresso_product_sale_position',
		'type' => 'radio',
		'choices' => 
	array(
		'left' => __('Left', 'coffee-espresso'),
		'right' => __('Right', 'coffee-espresso'),
	),
));

// WooCommerce Pages Product Border Radius
$wp_customize->add_setting(
	'coffee_espresso_woocommerce_product_border_radius',
	array(
		'default'           => 3,
		'sanitize_callback' => 'coffee_espresso_sanitize_range_value',
	)
);
$wp_customize->add_control(
	new coffee_espresso_Customize_Range_Control(
		$wp_customize,
		'coffee_espresso_woocommerce_product_border_radius',
		array(
			'label'       => __( 'Product Border Radius Setting', 'coffee-espresso' ),
			'description' => __( 'Adjust the border radius of WooCommerce product boxes.', 'coffee-espresso' ),
			'section'     => 'coffee_espresso_woocommerce_settings',
			'settings'    => 'coffee_espresso_woocommerce_product_border_radius',
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 50,
				'step' => 1,
			),
		)
	)
);