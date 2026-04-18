<?php
/**
 * Excerpt
 *
 * @package coffee_espresso
 */

$wp_customize->add_section(
	'coffee_espresso_excerpt_options',
	array(
		'panel' => 'coffee_espresso_theme_options',
		'title' => esc_html__( 'Excerpt', 'coffee-espresso' ),
	)
);

// Excerpt - Excerpt Length.
$wp_customize->add_setting(
	'coffee_espresso_excerpt_length',
	array(
		'default'           => 20,
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	'coffee_espresso_excerpt_length',
	array(
		'label'       => esc_html__( 'Excerpt Length (no. of words)', 'coffee-espresso' ),
		'section'     => 'coffee_espresso_excerpt_options',
		'settings'    => 'coffee_espresso_excerpt_length',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 10,
			'max'  => 200,
			'step' => 1,
		),
	)
);