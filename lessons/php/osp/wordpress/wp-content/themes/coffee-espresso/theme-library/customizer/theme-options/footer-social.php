<?php
/**
 * Footer Social Icons
 *
 * @package coffee_espresso
 */

$wp_customize->add_section(
	'coffee_espresso_footer_icon_options',
	array(
		'panel' => 'coffee_espresso_theme_options',
		'title' => esc_html__( 'Footer Social Icons', 'coffee-espresso' ),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_footer_icon_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_footer_icon_separators', array(
	'label' => __( 'Footer Icon Settings', 'coffee-espresso' ),
	'section' => 'coffee_espresso_footer_icon_options',
	'settings' => 'coffee_espresso_footer_icon_separators',
)));

// Footer Section - Enable Section.
$wp_customize->add_setting(
	'coffee_espresso_enable_footer_icon_section',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_enable_footer_icon_section',
		array(
			'label'    => esc_html__( 'Show / Hide Footer Icon', 'coffee-espresso' ),
			'section'  => 'coffee_espresso_footer_icon_options',
			'settings' => 'coffee_espresso_enable_footer_icon_section',
		)
	)
);

// Add setting for Facebook Link
$wp_customize->add_setting(
	'coffee_espresso_footer_facebook_link',
	array(
		'default'           => 'https://www.facebook.com/',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'coffee_espresso_footer_facebook_link',
	array(
		'label'           => esc_html__( 'Facebook Link', 'coffee-espresso'  ),
		'section'         => 'coffee_espresso_footer_icon_options',
		'settings'        => 'coffee_espresso_footer_facebook_link',
		'type'      => 'url'
	)
);

// Add setting for Facebook Icon Changing
$wp_customize->add_setting(
	'coffee_espresso_facebook_icon',
	array(
        'default' => 'fab fa-facebook-f',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
		
	)
);	

$wp_customize->add_control(new Coffee_Espresso_Change_Icon_Control($wp_customize, 
	'coffee_espresso_facebook_icon',
	array(
	    'label'   		=> __('Facebook Icon','coffee-espresso'),
	    'section' 		=> 'coffee_espresso_footer_icon_options',
		'iconset' => 'fb',
	))  
);


// Add setting for Twitter Link
$wp_customize->add_setting(
	'coffee_espresso_footer_twitter_link',
	array(
		'default'           => 'https://x.com/',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'coffee_espresso_footer_twitter_link',
	array(
		'label'           => esc_html__( 'Twitter Link', 'coffee-espresso'  ),
		'section'         => 'coffee_espresso_footer_icon_options',
		'settings'        => 'coffee_espresso_footer_twitter_link',
		'type'      => 'url'
	)
);

// Add setting for Twitter Icon Changing
$wp_customize->add_setting(
	'coffee_espresso_twitter_icon',
	array(
        'default' => 'fab fa-twitter',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
		
	)
);	

$wp_customize->add_control(new Coffee_Espresso_Change_Icon_Control($wp_customize, 
	'coffee_espresso_twitter_icon',
	array(
	    'label'   		=> __('Twitter Icon','coffee-espresso'),
	    'section' 		=> 'coffee_espresso_footer_icon_options',
		'iconset' => 'fb',
	))  
);

// Add setting for Instagram Link
$wp_customize->add_setting(
	'coffee_espresso_footer_instagram_link',
	array(
		'default'           => 'https://www.instagram.com/',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'coffee_espresso_footer_instagram_link',
	array(
		'label'           => esc_html__( 'Instagram Link', 'coffee-espresso'  ),
		'section'         => 'coffee_espresso_footer_icon_options',
		'settings'        => 'coffee_espresso_footer_instagram_link',
		'type'      => 'url'
	)
);

// Add setting for Instagram Icon Changing
$wp_customize->add_setting(
	'coffee_espresso_instagram_icon',
	array(
        'default' => 'fab fa-instagram',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
		
	)
);	

$wp_customize->add_control(new Coffee_Espresso_Change_Icon_Control($wp_customize, 
	'coffee_espresso_instagram_icon',
	array(
	    'label'   		=> __('Instagram Icon','coffee-espresso'),
	    'section' 		=> 'coffee_espresso_footer_icon_options',
		'iconset' => 'fb',
	))  
);

// Add setting for Linkedin Link
$wp_customize->add_setting(
	'coffee_espresso_footer_linkedin_link',
	array(
		'default'           => 'https://in.linkedin.com/',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'coffee_espresso_footer_linkedin_link',
	array(
		'label'           => esc_html__( 'Linkedin Link', 'coffee-espresso'  ),
		'section'         => 'coffee_espresso_footer_icon_options',
		'settings'        => 'coffee_espresso_footer_linkedin_link',
		'type'      => 'url'
	)
);

// Add setting for Linkedin Icon Changing
$wp_customize->add_setting(
	'coffee_espresso_linkedin_icon',
	array(
        'default' => 'fab fa-linkedin',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
		
	)
);	

$wp_customize->add_control(new Coffee_Espresso_Change_Icon_Control($wp_customize, 
	'coffee_espresso_linkedin_icon',
	array(
	    'label'   		=> __('Linkedin Icon','coffee-espresso'),
	    'section' 		=> 'coffee_espresso_footer_icon_options',
		'iconset' => 'fb',
	))  
);

// Add setting for Youtube Link
$wp_customize->add_setting(
	'coffee_espresso_footer_youtube_link',
	array(
		'default'           => 'https://www.youtube.com/',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'coffee_espresso_footer_youtube_link',
	array(
		'label'           => esc_html__( 'Youtube Link', 'coffee-espresso'  ),
		'section'         => 'coffee_espresso_footer_icon_options',
		'settings'        => 'coffee_espresso_footer_youtube_link',
		'type'      => 'url'
	)
);

// Add setting for Youtube Icon Changing
$wp_customize->add_setting(
	'coffee_espresso_youtube_icon',
	array(
        'default' => 'fab fa-youtube',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
		
	)
);	

$wp_customize->add_control(new Coffee_Espresso_Change_Icon_Control($wp_customize, 
	'coffee_espresso_youtube_icon',
	array(
	    'label'   		=> __('Youtube Icon','coffee-espresso'),
	    'section' 		=> 'coffee_espresso_footer_icon_options',
		'iconset' => 'fb',
	))  
);

//Icon Alignment
$wp_customize->add_setting(
	'coffee_espresso_footer_social_align',
	array(
		'default' 			=> 'center',
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'coffee_espresso_footer_social_align',
	array(
		'label' => __('Icon Alignment ','coffee-espresso'),
		'section' => 'coffee_espresso_footer_icon_options',
		'type'			=> 'select',
		'choices' => 
		array(
			'left' => __('Left','coffee-espresso'),
			'right' => __('Right','coffee-espresso'),
			'center' => __('Center','coffee-espresso'),
		),
	)
);