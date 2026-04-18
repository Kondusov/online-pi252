<?php
/**
 * Color Option
 *
 * @package coffee_espresso
 */

// Primary Color.
$wp_customize->add_setting(
	'coffee_espresso_primary_color',
	array(
		'default'           => '#8E5331',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'coffee_espresso_primary_color',
		array(
			'label'    => __( 'Primary Color', 'coffee-espresso' ),
			'section'  => 'colors',
			'priority' => 5,
		)
	)
);