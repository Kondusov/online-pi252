<?php
/**
 * Single Post Options
 *
 * @package coffee_espresso
 */

$wp_customize->add_section(
	'coffee_espresso_single_post_options',
	array(
		'title' => esc_html__( 'Single Post Options', 'coffee-espresso' ),
		'panel' => 'coffee_espresso_theme_options',
	)
);

// Post Options - Show / Hide Date.
$wp_customize->add_setting(
	'coffee_espresso_single_post_hide_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_single_post_hide_date',
		array(
			'label'   => esc_html__( 'Show / Hide Date', 'coffee-espresso' ),
			'section' => 'coffee_espresso_single_post_options',
		)
	)
);

// Post Options - Show / Hide Author.
$wp_customize->add_setting(
	'coffee_espresso_single_post_hide_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_single_post_hide_author',
		array(
			'label'   => esc_html__( 'Show / Hide Author', 'coffee-espresso' ),
			'section' => 'coffee_espresso_single_post_options',
		)
	)
);

// Post Options - Show / Hide Comments.
$wp_customize->add_setting(
	'coffee_espresso_single_post_hide_comments',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_single_post_hide_comments',
		array(
			'label'   => esc_html__( 'Show / Hide Comments', 'coffee-espresso' ),
			'section' => 'coffee_espresso_single_post_options',
		)
	)
);

// Post Options - Show / Hide Time.
$wp_customize->add_setting(
	'coffee_espresso_single_post_hide_time',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_single_post_hide_time',
		array(
			'label'   => esc_html__( 'Show / Hide Time', 'coffee-espresso' ),
			'section' => 'coffee_espresso_single_post_options',
		)
	)
);

// Post Options - Show / Hide Category.
$wp_customize->add_setting(
	'coffee_espresso_single_post_hide_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_single_post_hide_category',
		array(
			'label'   => esc_html__( 'Show / Hide Category', 'coffee-espresso' ),
			'section' => 'coffee_espresso_single_post_options',
		)
	)
);

// Post Options - Show / Hide Tag.
$wp_customize->add_setting(
	'coffee_espresso_post_hide_tags',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_post_hide_tags',
		array(
			'label'   => esc_html__( 'Show / Hide Tag', 'coffee-espresso' ),
			'section' => 'coffee_espresso_single_post_options',
		)
	)
);

// Post Options - Comment Title.
$wp_customize->add_setting(
	'coffee_espresso_blog_post_comment_title',
	array(
		'default'=> 'Leave a Reply',
		'sanitize_callback'	=> 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'coffee_espresso_blog_post_comment_title',
	array(
		'label'	=> __('Comment Title','coffee-espresso'),
		'input_attrs' => array(
			'placeholder' => __( 'Leave a Reply', 'coffee-espresso' ),
		),
		'section'=> 'coffee_espresso_single_post_options',
		'type'=> 'text'
	)
);

// ---------------------------------------- PROGRESS BAR ----------------------------------------------------
$wp_customize->add_setting( 'coffee_espresso_progress_bar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_progress_bar_separator',array(
		'label' => __( 'Enable / Disable Progress Bar', 'coffee-espresso' ),
		'section' => 'coffee_espresso_general_options',
	)
) );
// Progress Bar Enable / Disable
$wp_customize->add_setting('coffee_espresso_progress_bar',array(
		'default'           => false,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);
$wp_customize->add_control(new Coffee_Espresso_Toggle_Switch_Custom_Control(
	$wp_customize,'coffee_espresso_progress_bar',array(
			'label'   => __( 'Enable Progress Bar', 'coffee-espresso' ),
			'section' => 'coffee_espresso_general_options',
		)
	)
);