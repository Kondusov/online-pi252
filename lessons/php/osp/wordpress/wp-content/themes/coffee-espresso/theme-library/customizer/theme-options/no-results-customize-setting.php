<?php
/**
 * No Results page
 *
 * @package coffee_espresso
 */

/*=========================================
No Results Page
=========================================*/
$wp_customize->add_section(
	'no_results_pg_options', array(
		'title' => esc_html__( 'No Results Page', 'coffee-espresso' ),
		'panel' => 'coffee_espresso_theme_options',
	)
);

//  Title // 
$wp_customize->add_setting(
	'coffee_espresso_pg_no_results_ttl',
	array(
        'default'			=> __('Nothing Found','coffee-espresso'),
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'coffee_espresso_sanitize_html',
	)
);	

$wp_customize->add_control( 
	'coffee_espresso_pg_no_results_ttl',
	array(
	    'label'   => __('No Results Title','coffee-espresso'),
	    'section' => 'no_results_pg_options',
		'type'           => 'text',
	)  
);

//  Text // 
$wp_customize->add_setting(
	'coffee_espresso_pg_no_results_text',
	array(
        'default'			=> __('Sorry, but nothing matched your search terms. Please try again with some different keywords.','coffee-espresso'),
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'coffee_espresso_sanitize_html',
	)
);	

$wp_customize->add_control( 
	'coffee_espresso_pg_no_results_text',
	array(
	    'label'   => __('No Results Text','coffee-espresso'),
	    'section' => 'no_results_pg_options',
		'type'           => 'text',
	)  
);