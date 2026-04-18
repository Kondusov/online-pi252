<?php
/**
 * Typography Setting
 *
 * @package coffee_espresso
 */

// Typography Setting
$wp_customize->add_section(
    'coffee_espresso_typography_setting',
    array(
        'panel' => 'coffee_espresso_theme_options',
        'title' => esc_html__( 'Typography Setting', 'coffee-espresso' ),
    )
);

$wp_customize->add_setting(
    'coffee_espresso_site_title_font',
    array(
        'default'           => 'Cinzel',
        'sanitize_callback' => 'coffee_espresso_sanitize_google_fonts',
    )
);

$wp_customize->add_control(
    'coffee_espresso_site_title_font',
    array(
        'label'    => esc_html__( 'Site Title Font Family', 'coffee-espresso' ),
        'section'  => 'coffee_espresso_typography_setting',
        'settings' => 'coffee_espresso_site_title_font',
        'type'     => 'select',
        'choices'  => coffee_espresso_get_all_google_font_families(),
    )
);

// Typography - Site Description Font.
$wp_customize->add_setting(
	'coffee_espresso_site_description_font',
	array(
		'default'           => 'Tenor Sans',
		'sanitize_callback' => 'coffee_espresso_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'coffee_espresso_site_description_font',
	array(
		'label'    => esc_html__( 'Site Description Font Family', 'coffee-espresso' ),
		'section'  => 'coffee_espresso_typography_setting',
		'settings' => 'coffee_espresso_site_description_font',
		'type'     => 'select',
		'choices'  => coffee_espresso_get_all_google_font_families(),
	)
);

// Typography - Header Font.
$wp_customize->add_setting(
	'coffee_espresso_header_font',
	array(
		'default'           => 'Inter',
		'sanitize_callback' => 'coffee_espresso_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'coffee_espresso_header_font',
	array(
		'label'    => esc_html__( 'Heading Font Family', 'coffee-espresso' ),
		'section'  => 'coffee_espresso_typography_setting',
		'settings' => 'coffee_espresso_header_font',
		'type'     => 'select',
		'choices'  => coffee_espresso_get_all_google_font_families(),
	)
);

// Typography - Body Font.
$wp_customize->add_setting(
	'coffee_espresso_content_font',
	array(
		'default'           => 'Inter',
		'sanitize_callback' => 'coffee_espresso_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'coffee_espresso_content_font',
	array(
		'label'    => esc_html__( 'Content Font Family', 'coffee-espresso' ),
		'section'  => 'coffee_espresso_typography_setting',
		'settings' => 'coffee_espresso_content_font',
		'type'     => 'select',
		'choices'  => coffee_espresso_get_all_google_font_families(),
	)
);